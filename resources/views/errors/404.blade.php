@extends('layouts.error', [
    'errorCode' => '404',
    'errorTitle' => 'Not Found'
])

@section('status-body')
    <p>
        We're sorry, but the resource you were looking for seems to be missing. Please go back to the homepage and see if you can find it again.
    </p>
@endsection

@section('status-footer')
    <p>
        <a href="{{ route('home') }}">Back to homepage</a>
    </p>
@endsection
