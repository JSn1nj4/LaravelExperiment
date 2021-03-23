<?php

namespace App\Console\Commands;

use App\Http\Clients\GitHubClient;
use App\Models\GithubEvent;
use App\Models\GithubUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GitHubActivityPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:activity:pull
                            {--d|debug : Dump response data or log API errors.}
                            {--f|file= : Name of file to store JSON response to. Assumes response is for debugging only, not database storage. Response will also not be dumped to the console.}
                            {--c|count=5 : Choose how many events to pull from GitHub API. Only works if --debug is used.}
                            {--s|since= : Event ID to reference for fetching other events.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if(in_array($event_data['type'], [
            'CreateEvent',
            'DeleteEvent',
            'PushEvent',
        ])) {
            return $event_data['payload']['ref'];
        }

        if($event_data['type'] === 'ForkEvent') {
            return $event_data['payload']['forkee']['full_name'];
        }

        if(in_array($event_data['type'], [
            'IssueCommentEvent',
            'IssuesEvent',
        ])) {
            return $event_data['payload']['issue']['number'];
        }

        if($event_data['type'] === 'PullRequestEvent') {
            return $event_data['payload']['pull_request']['number'];
        }

        /**
         * Events that don't have an "event source":
         *  - PublicEvent
         *  - WatchEvent
         */
        return null;
    }

    /**
     * Set event action name if necessary
     */
    private function getAction(array $event_data): ?string
    {
        return null;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $github = new GitHubClient;

        $activity = $github->getActivity('JSn1nj4', $this->option('count'));

        if($this->option('file')) {
            Storage::disk('debug')->put($this->option('file'), $activity->toJson());

            return 0;
        }

        if($this->option('debug')) {
            dd($activity);
        }

        collect($activity)->map(function($event_data, $key) {
            $user_data = $event_data['actor'];
            $user = GithubUser::firstOrCreate(['id' => $user_data['id']], [
                'login' => $user_data['login'],
                'display_login' => $user_data['display_login'],
                'avatar_url' => $user_data['avatar_url'],
            ]);

            $event = GithubEvent::firstOrCreate(['id' => intval($event_data['id'])], [
                'type' => $event_data['type'],
                'action' => $this->getAction($event_data),
                'date' => Carbon::make($event_data['created_at'])->format('Y-m-d H:i:s'),
                'user_id' => $user->id,
                'source' => $this->getEventSource($event_data),
                'repo' => $event_data['repo']['name'],
            ]);
        });

        return 0;
    }
}
