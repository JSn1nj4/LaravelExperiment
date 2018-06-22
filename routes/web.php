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

// Enable/disable maintenance splash page
$maintenance = false;

Route::get('/', function() {

    /*
     * Temporary redirect until site is built
     *
     * Once the homepage and overall look are built, this will be removed. The
     * others will still show a "coming soon" page of sorts, but it'll be an
     * actual page that says "coming soon" on it, not a "coming soon" splash
     * screen.
     */
    return !Auth::check() ? redirect()->route('site.coming-soon') : view('home');

})->name('home');

Route::get('/projects', function() {
    return !Auth::check() ? redirect()->route('site.coming-soon') : view('projects');
})->name('projects');

Route::get('/updates', function() {
    return !Auth::check() ? redirect()->route('site.coming-soon') : view('updates');
})->name('updates');

Route::view('/coming-soon', 'site-coming-soon')->name('site.coming-soon');
Route::view('/maintenance', 'site-maintenance')->name('site.maintenance');
