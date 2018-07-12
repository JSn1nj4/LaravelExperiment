@extends('layouts.error', [
    'errorCode' => '404',
    'errorTitle' => 'Not Found',
    'errorMessage' => 'Sorry, we couldn\'t locate the resource you were looking for.'
])

@section('extra-content')
    <a href="/">Back to homepage</a>
@endsection
