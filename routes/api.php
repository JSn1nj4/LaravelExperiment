<?php

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
    Route::get('/', 'ProjectsApiController@index');
    Route::get('/{count}', 'ProjectsApiController@index');
});

// Retrieve list of tweets
Route::get('/tweets', 'TweetController@index');
Route::get('/tweets/{count}', 'TweetController@index');
Route::get('/tweets/{count}/demo', 'TweetController@index');

// Retrieve single tweets
Route::get('/tweet/{id}', 'TweetController@show');

// Retrieve GitHub activity
Route::get('/github/activity', 'GitHubActivityController@index');
Route::get('/github/activity/{count}', 'GitHubActivityController@index');
