<?php

namespace App\Console\Commands;

use App\Events\GithubEventsPulledEvent;
use App\Http\Clients\GithubClient;
use App\Models\GithubEvent;
use App\Models\GithubUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GithubEventPullCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:event:pull
                            {--d|debug : Dump response data or log API errors.}
                            {--f|file= : Name of file to store JSON response to. Assumes response is for debugging only, not database storage. Response will also not be dumped to the console.}
                            {--c|count=5 : Choose how many events to pull from GitHub API. Only works if --debug is used.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch events from GitHub\'s events API.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Determine the source of the event based on its type
     */
    private function getEventSource(array $event_data): ?string
    {
        $types_map = [
            'CreateEvent' => fn($data) => $data['payload']['ref'],
            'DeleteEvent' => fn($data) => $data['payload']['ref'],
            'ForkEvent' => fn($data) => $data['payload']['forkee']['full_name'],
            'IssueCommentEvent' => fn($data) => $data['payload']['issue']['number'],
            'IssuesEvent' => fn($data) => $data['payload']['issue']['number'],
            'PullRequestEvent' => fn($data) => $data['payload']['pull_request']['number'],
            'PushEvent' => fn($data) => $data['payload']['ref'],
            'PublicEvent' => fn($data) => null,
            'WatchEvent' => fn($data) => null,
        ];

        return $types_map[$event_data['type']]($event_data);
    }

    /**
     * Set event action name if necessary
     */
    private function getAction(array $event_data): ?string
    {
        $types_map = [
            'CreateEvent' => fn($data) => null,
            'DeleteEvent' => fn($data) => null,
            'ForkEvent' => fn($data) => null,
            'IssueCommentEvent' => fn($data) => null,
            'IssuesEvent' => function($data) {
                return \optional($data['payload'])['action'];
            },
            'PullRequestEvent' => function($data) {
                if(\optional($data['payload'])['merged'] === true) {
                    return 'merged';
                }

                return \optional($data['payload'])['action'];
            },
            'PushEvent' => fn($data) => null,
            'PublicEvent' => fn($data) => null,
            'WatchEvent' => fn($data) => null,
        ];

        return $types_map[$event_data['type']]($event_data);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $github = new GithubClient;

		$this->info("Fetching GitHub events...");

        $events = $github->getEvents('JSn1nj4', $this->option('count'));

        if($this->option('file')) {
            Storage::disk('debug')->put($this->option('file'), $events->toJson());

            return 0;
        }

        if($this->option('debug')) {
            dd($events);
        }

        collect($events)->map(function($event_data, $key) {
            $user_data = $event_data['actor'];
            $user = GithubUser::firstOrCreate(['id' => $user_data['id']], [
                'login' => $user_data['login'],
                'display_login' => $user_data['display_login'],
                'avatar_url' => $user_data['avatar_url'],
            ]);

            GithubEvent::firstOrCreate(['id' => intval($event_data['id'])], [
                'type' => $event_data['type'],
                'action' => $this->getAction($event_data),
                'date' => Carbon::make($event_data['created_at'])->format('Y-m-d H:i:s'),
                'user_id' => $user->id,
                'source' => $this->getEventSource($event_data),
                'repo' => $event_data['repo']['name'],
            ]);
        });

        $this->info('GitHub events fetched');

        GithubEventsPulledEvent::dispatch();

        return 0;
    }
}
