@extends('layouts.error', [
    'errorCode' => '404',
    'errorTitle' => 'Not Found'
])

@section('status-body')
    <p>
        Sorry, we couldn't locate the resource you were looking for.

@section('status-footer')
    <p>
        <a href="{{ route('home') }}">Back to homepage</a>
    </p>
@endsection
