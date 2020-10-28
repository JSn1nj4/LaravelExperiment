<?php

use App\Http\Controllers\GitHubActivityController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TweetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// For working with projects
Route::prefix('/projects')->group(function() {
    Route::get('/', [ProjectsController::class, 'index']);
    Route::get('/{count}', [ProjectsController::class, 'index']);
});

// Retrieve list of tweets
Route::get('/tweets', [TweetController::class, 'index']);
Route::get('/tweets/{count}', [TweetController::class, 'index']);
Route::get('/tweets/{count}/demo', [TweetController::class, 'index']);

// Retrieve GitHub activity
Route::get('/github/activity', [GitHubActivityController::class, 'index']);
Route::get('/github/activity/{count}', [GitHubActivityController::class, 'index']);
