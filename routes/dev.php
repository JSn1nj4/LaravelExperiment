<?php

use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::view('/updates', 'updates')->name('updates');

// error page testing route (only works locally)
Route::get('/error/{code}', function ($code = null) {
	if (!view()->exists("errors.$code")) abort(404);

	abort($code);
})->where('code', '[1-5][0-9]{2}');


Route::prefix('admin')->group(function() {
	Route::get('/login', function() {
		return view('admin.login');
	})->name('admin.login');

	Route::middleware('auth')->group(function () {

	});
});
