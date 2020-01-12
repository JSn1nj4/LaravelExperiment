<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsApiController;

class ProjectsController extends Controller
{
    private $projectsApi;

    public function __construct()
    {
        if (!in_array(Route::currentRouteName(), config('app.enabled-pages'))) {
            abort(404);
        }

        $this->projectsApi = new ProjectsApiController;
    }

    public function index(int $count = 10)
    {
        $projects = $this->projectsApi->index($count);

        return view('projects.index', compact('projects'));
    }
}
