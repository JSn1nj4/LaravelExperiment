<?php

namespace App\Console\Commands;

use App\Events\TweetsPulledEvent;
use App\Http\Clients\TwitterClient;
use App\Models\Tweet;
use App\Models\TwitterUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TweetPullCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:pull {--d|debug} {--f|fake}';

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

        $newest_id = optional(DB::table('tweets')->latest('date')->first())->id;

        $this->info("Fetching tweets" .
            ($newest_id !== null ? " since tweet {$newest_id}" : "") .
            "...");

        // Run the command without actually connecting to the Twitter API
        if(!$this->option('fake')) {
            collect($twitter->getTweets($user, $newest_id))->map(function ($tweet_data, $key) {
                $user_data = $tweet_data['user'];

                $user = TwitterUser::firstOrCreate(['id' => $user_data['id']], [
                    'name' => $user_data['name'],
                    'screen_name' => $user_data['screen_name'],
                    'profile_image_url_https' => $user_data['profile_image_url_https'],
                ]);

                Tweet::firstOrCreate(['id' => $tweet_data['id_str']], [
                    'user_id' => $user->id,
                    'body' => $tweet_data['text'],
                    'date' => Carbon::make($tweet_data['created_at'])->format('Y-m-d H:i:s'),
                    'entities' => $tweet_data['entities'],
                ]);
            });
        }

        $this->info('Tweets fetched');

        TweetsPulledEvent::dispatch();

        return 0;
    }
}
