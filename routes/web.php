<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// standard views
Route::view('/', 'home')->name('home');
Route::get('/projects', 'ProjectsController@index')->name('projects');

Route::get('/updates', function() {
    $routeName = Route::currentRouteName();

    if(!config('app.enable-' . $routeName)) {
        abort(404);
    }

    return view($routeName);
})->name('updates');

// error page testing route (only works locally)
Route::get('/error/{code}', function($code = null) {
    if(config('app.env') !== 'local') abort(404);

    if(!view()->exists("errors.$code")) abort(404);

    abort($code);
})->where('code', '[1-5][0-9]{2}');
