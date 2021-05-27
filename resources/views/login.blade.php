@extends('layouts.page')

@section('content')
	<form action="{{ route('login.attempt') }}" method="POST">
		@csrf
		<p><input class="bg-gray-900" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"></p>
		<p><input class="bg-gray-900" type="password" name="password" placeholder="Password"></p>
		<p><button type="submit">Submit</button></p>
	</form>
	@if (optional($errors)->count() >= 1)
		<p class="border-red-500 border-2 border-solid text-red-500">{{ $errors->default->first('login') }}</p>
		<p>
			<strong class="font-bold">All errors:</strong><br>
			<pre class="font-mono">{{ dump($errors) }}</pre>
		</p>
	@endif
@endsection
