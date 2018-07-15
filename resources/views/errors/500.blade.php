@extends('layouts.error', [
    'errorCode' => '500',
    'errorTitle' => !empty($exception->getMessage()) ? $exception->getMessage() : 'Internal Server Error'
])

@section('status-body')
    <p>
        Something went wrong on the back-end. If this issue continues, please contact me via <a href="https://twitter.com/JSn1nj4">Twitter</a>.
    </p>
@endsection

@section('status-footer')
    <p>
        <a href="{{ route('home') }}">Back to homepage</a>
    </p>
@endsection
