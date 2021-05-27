<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
	{
		if(Auth::check()) {
			return redirect()->route('admin.dashboard');
		}

		return view('login');
	}

	public function store(Request $request)
	{
		// Validator::make($request->all(), [
		// 	'email' => 'required|email',
		// 	'password' => 'required'
		// ])->validate();

		if(Auth::attempt($request->only('email', 'password'))) {
			$request->session()->regenerate();

			return redirect()->intended(route('dashboard'));
		}

		return back()->withErrors([
			'login' => 'Login information is incorrect.',
		])->withInput();
	}
}
