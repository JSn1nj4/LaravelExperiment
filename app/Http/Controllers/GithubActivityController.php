<?php

namespace App\Http\Controllers;

use App\Models\GithubEvent;

class GithubActivityController extends Controller
{
    /**
     * GitHubActivityController constructor method
     *
     * @method                  __construct
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Index recent GitHub activity events
     *
     * @method                  index
     * @access public
     *
     * @param integer           $count
     *
     * @return array
     *
     * This will return an asociative array that should automatically be
     * converted to JSON on the front-end.
     */
    public function index(int $count = 7)
    {
        return GithubEvent::with('user')
                ->latest('date')
                ->take($count)
                ->get();
    }
}
