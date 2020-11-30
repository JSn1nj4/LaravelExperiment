<?php

namespace App\Console\Commands;

use App\Http\Clients\GitHubClient;
use Illuminate\Console\Command;

class GitHubActivityPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:activity:pull
                            {--d|debug : Dump response data or log API errors}
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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $github = new GitHubClient;

        if($this->option('debug')) {
            $activity = $github->getActivity('JSn1nj4', $this->option('count'));

            dd($activity);
        }

        return 0;
    }
}
