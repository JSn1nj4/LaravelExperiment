<?php

namespace App\Listeners;

use App\Events\GithubEventsPulled;
use Illuminate\Support\Facades\Artisan;

class PruneOldGithubEvents
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
     * @param  object  $event
     * @return void
     */
    public function handle(GithubEventsPulled $event)
    {
        Artisan::call('github:activity:prune');
    }
}
