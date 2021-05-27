@extends('admin.layouts.master')

@section('body')
	<h1 class="text-8xl">YOU MADE IT!</h1>
	<p><a href="{{ route('logout') }}" class="p-8 inline-block border-solid border-2 border-white">Log Out</a></p>
@endsection
