<?php

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

// splash page views
Route::view('/coming-soon', 'splashes.coming-soon')->name('coming-soon');
Route::view('/maintenance', 'splashes.maintenance')->name('maintenance');

// standard views
Route::view('/', 'home')->name('home');
// Route::view('/projects', 'projects')->name('projects');

Route::get('/updates', function() {
    $routeName = Route::currentRouteName();

    if(!config('app.enable-' . $routeName)) {
        abort(404);
    }

    return view($routeName);
})->name('updates');

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
 Route::any('/{any?}', function($any = null) {
     abort(404);
 })->where('any', '.*');
