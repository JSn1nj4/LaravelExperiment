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
    if(!Auth::check()) {
        return redirect()->route('site.coming-soon');
    }

    return view('home');
})->name('home');

Route::get('/projects', function() {
    if(!Auth::check()) {
        return redirect()->route('site.coming-soon');
    }

    return view('projects');
})->name('projects');

Route::get('/updates', function() {
    if(!Auth::check()) {
        return redirect()->route('site.coming-soon');
    }

    return view('updates');
})->name('updates');

Route::view('/coming-soon', 'site-coming-soon')->name('site.coming-soon');
// Route::view('/maintenance', 'site-maintenance')->name('site.maintenance');
