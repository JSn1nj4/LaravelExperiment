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

    if(!$code || $code === '') abort(404);

    if(!view()->exists("errors.$code")) abort(404);

    return view("errors.$code");
});

/*
 * A catch-all route for throwing 404s
 *
 * This route will be used automatically when another pre-defined route
 * isn't hit by the web browser. The browser would normally throw 404s
 * anyway, but the coming-soon and maintenance routes could also be
 * circumvented.
 *
 * This catch-all route should prevent that from happening
 * while still throwing 404s otherwise.
 */
 Route::any('/{any?}', fn ($any = null) => abort(404))->where('any', '.*');
