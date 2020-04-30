@extends('layouts.error', [
    'errorCode' => '404',
    'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '') ? $exception->getMessage() : 'Not Found'
])

@section('status-body')
    <p>
        We're sorry, but the resource you were looking for seems to be missing. Please try finding it again, starting from the homepage.
    </p>
@endsection

@section('status-footer')
    <p>
        <a href="{{ route('home') }}">Back to homepage</a>
    </p>
@endsection
