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

Route::get('/', function() {

    /*
     * Temporary redirect until site is built
     *
     * Once the homepage and overall look are built, this will be removed. The
     * others will still show a "coming soon" page of sorts, but it'll be an
     * actual page that says "coming soon" on it, not a "coming soon" splash
     * screen.
     */

    if(config('app.coming_soon')) {
        return redirect()->route('coming-soon');
    }

    if(config('app.maintenance')) {
        return redirect()->route('maintenance');
    }

    return view('home');

})->name('home');

Route::get('/about', function() {

    if(config('app.coming_soon')) {
        return redirect()->route('coming-soon');
    }

    if(config('app.maintenance')) {
        return redirect()->route('maintenance');
    }

    return view('about');

})->name('about');

Route::get('/projects', function() {
    if(config('app.coming_soon')) {
        return redirect()->route('coming-soon');
    }

    if(config('app.maintenance')) {
        return redirect()->route('maintenance');
    }

    return view('projects');
})->name('projects');

Route::get('/updates', function() {
    if(config('app.coming_soon')) {
        return redirect()->route('coming-soon');
    }

    if(config('app.maintenance')) {
        return redirect()->route('maintenance');
    }

    return view('updates');
})->name('updates');

Route::get('/coming-soon', function() {
    if(!config('app.coming_soon')) {
        return redirect()->route('home');
    }

    if(config('app.maintenance')) {
        redirect()->route('maintenance');
    }

    return view('splashes.coming-soon');
})->name('coming-soon');

Route::get('/maintenance', function() {
    if(config('app.coming_soon')) {
        return redirect()->route('coming-soon');
    }

    if(!config('app.maintenance')) {
        redirect()->route('home');
    }

    return view('splashes.maintenance');
})->name('maintenance');

/*
 * A catch-all route
 *
 * This is specifically for catching every request that doesn't match a disk
 * resource or one of the named routes above. The only real reason this is here
 * is to show the maintenance or coming soonn pages when their environment
 * variables are set.
 *
 * This is not ideal for this purpose, considering it doesn't solve the problem
 * for 100% of the possible requested routes, but it will do for the time being.
 */

Route::get('/{view}', function($view) {

    if(config('app.coming_soon')) {
        return redirect()->route('coming-soon');
    }

    if(config('app.maintenance')) {
        return redirect()->route('maintenance');
    }

    abort(404);

})->where('view', '.*');
