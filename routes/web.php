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
    // Route::view('/projects', 'projects')->name('projects');
    // Route::view('/updates', 'updates')->name('updates');

Route::get('/coming-soon', function() {
    if(!config('app.coming_soon') && !App::environment('local')) {
        return redirect()->route('home');
    }

    return view('splashes.coming-soon');
})->name('coming-soon');

Route::get('/maintenance', function() {
    if(!config('app.maintenance') && !App::environment('local')) {
        redirect()->route('home');
    }

    return view('splashes.maintenance');
})->name('maintenance');

