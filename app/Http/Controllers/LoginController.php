<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
	{
		if(Auth::check()) {
			return redirect()->route('admin.dashboard');
		}

		return view('login');
	}

	public function store(Request $request, string $email, string $password)
	{

	}
}
