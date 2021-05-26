@extends('layouts.page')

@section('content')
	@if (isset($data))
		<pre>
			@dump($data)
		</pre>
	@endif

	<form action="{{ route('login.attempt') }}" method="POST">
		@csrf
		<p><input class="bg-gray-900" type="email" name="email" placeholder="Email Address" id=""></p>
		<p><input class="bg-gray-900" type="password" name="password" placeholder="Password" id=""></p>
		<p><button type="submit">Submit</button></p>
	</form>
@endsection
