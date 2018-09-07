<?php

namespace App\Http\Controllers;

use App\GitHubActivity;

class GitHubActivityController extends Controller
{
    /**
     * Instance of GitHubActivity model
     *
     * @property object     $github_activity
     */
    private $github_activity;

    /**
     * GitHubActivityController constructor method
     *
     * @method              __construct
     * @return void
     */
    public function __construct()
    {
        $this->github_activity = new GitHubActivity;
    }

    /**
     * Index recent GitHub activity events
     *
     * @method              index
     * @param int           $count
     * @return array
     *
     * This will return an asociative array that should automatically be
     * converted to JSON on the front-end.
     */
    public function index(int $count = 7)
    {
        return $this->github_activity->getActivity($count);
    }
}
