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
Route::middleware('comingsoon', 'maintenance')->group(function() {
    // splash page views
    Route::view('/coming-soon', 'splashes.coming-soon')->name('coming-soon');
    Route::view('/maintenance', 'splashes.maintenance')->name('maintenance');

    // standard views
    Route::view('/', 'home')->name('home');
    Route::view('/about', 'about')->name('about');
    // Route::view('/projects', 'projects')->name('projects');
    // Route::view('/updates', 'updates')->name('updates');
});
