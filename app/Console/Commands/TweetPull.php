<?php

namespace App\Console\Commands;

use App\Http\Clients\TwitterClient;
use Illuminate\Console\Command;

class TweetPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:pull {--d|debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull tweets from the Twitter API';

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
        $twitter = new TwitterClient;
        $user = 'jsn1nj4';

        if($this->option('debug')) {
            dd($twitter->getTweets($user, null, true, 1));
        }

        return $twitter->getTweets($user);
    }
}
