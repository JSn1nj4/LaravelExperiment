@extends('admin.layouts.master')

@section('body')

	@include('admin.partials.header', [
		'menuItems' => [
			(object) ['name' => 'logout', 'label' => 'Log Out', 'icon' => 'fas fa-sign-out-alt']
		]
	])

	<h1 class="text-8xl">YOU MADE IT!</h1>
@endsection
