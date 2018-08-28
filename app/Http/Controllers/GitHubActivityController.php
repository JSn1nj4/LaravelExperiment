<?php

namespace App\Http\Controllers;

use App\GitHubActivity;

class GitHubActivityController extends Controller
{
    private $GitHubActivity;

    public function __construct()
    {
        $this->GitHubActivity = new GitHubActivity;
    }

    public function index(int $count = 5)
    {
        return ['message' => 'test'];
    }
}
