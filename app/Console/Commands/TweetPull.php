<?php

namespace App\Console\Commands;

use App\Http\Clients\TwitterClient;
use App\Models\Tweet;
use App\Models\TwitterUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

        $newest_id = optional(DB::table('tweets')->latest('date')->first())->tweet_id;

        collect($twitter->getTweets($user, $newest_id))->map(function($tweet_data, $key) {
            $user_data = $tweet_data['user'];

            $user = TwitterUser::firstOrCreate(['id' => $user_data['id']], [
                'name' => $user_data['name'],
                'screen_name' => $user_data['screen_name'],
                'profile_image_url_https' => $user_data['profile_image_url_https'],
            ]);

            $tweet = Tweet::firstOrCreate(['id' => $tweet_data['id']], [
                'user_id' => $user,
                'body' => $tweet_data['text'],
                'date' => $tweet_data['created_at'],
                'entities' => $tweet_data['entities'],
            ]);
        });

        return 0;
    }
}
