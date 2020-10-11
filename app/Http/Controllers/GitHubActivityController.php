<?php

namespace App\Http\Controllers;

use App\Models\GitHubActivity;
use App\Models\GitHubActivityOld;

class GitHubActivityController extends Controller
{
    /**
     * Used for interacting with the GitHub API
     *
     * @property App\Models\GitHubActivityOld         $github_activity
     * @access private
     */
    private $github_activity;

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
        $this->github_activity = new GitHubActivityOld;
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
        return $this->github_activity->getActivity($count);
    }
}
