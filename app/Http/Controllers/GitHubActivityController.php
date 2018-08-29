<?php

namespace App\Http\Controllers;

use App\GitHubActivity;

class GitHubActivityController extends Controller
{
    private $github_activity;

    public function __construct()
    {
        $this->github_activity = new GitHubActivity;
    }

    public function index(int $count = 5)
    {
        return $this->github_activity->getRawActivity( "$this->github_activity->api_url/users/JSn1nj4/events" );
    }
}
