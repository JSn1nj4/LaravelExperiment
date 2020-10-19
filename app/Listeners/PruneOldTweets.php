<?php

namespace App\Listeners;

use App\Events\TweetsPulled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PruneOldTweets
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TweetsPulled  $event
     * @return void
     */
    public function handle(TweetsPulled $event)
    {
        //
    }
}
