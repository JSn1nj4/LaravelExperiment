<?php

namespace App\Http\Controllers;

use App\Models\Login;
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

			Login::create(['user_id' => $request->user()->id]);

			return redirect()->intended(route('admin.dashboard'));
		}

		return back()->withErrors([
			'login' => 'Login information is incorrect.',
		])->withInput();
	}

	public function destroy(Request $request)
	{
		Auth::logout();
		return redirect()->route('login');
	}
}
