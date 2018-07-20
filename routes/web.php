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
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/projects', 'projects')->name('projects');
Route::view('/updates', 'updates')->name('updates');

Route::get('/coming-soon', function() {
    if(!config('app.coming_soon')) {
        return redirect()->route('home');
    }

    return view('splashes.coming-soon');
})->name('coming-soon');

Route::get('/maintenance', function() {
    if(!config('app.maintenance')) {
        redirect()->route('home');
    }

    return view('splashes.maintenance');
})->name('maintenance');

/*
 * Coming Soon and Maintenance redirects
 *
 * These are necessary to globally redirect browser requests website visitors to
 * Coming Soon and Maintenance pages, respectively. Putting them at the bottom
 * should mean that the above routes will have finished building before these
 * redirects are run.
 *
 * That last bit is important since these redirects use named routes.
 */

if(config('app.coming_soon')) {
    return redirect()->route('coming-soon');
}

if(config('app.maintenance')) {
    return redirect()->route('maintenance');
}
