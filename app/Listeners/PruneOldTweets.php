<?php

namespace App\Listeners;

use App\Events\TweetsPulled;

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
