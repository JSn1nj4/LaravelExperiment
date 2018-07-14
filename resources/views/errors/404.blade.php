@extends('layouts.error', [
    'errorCode' => '404',
    'errorTitle' => 'Not Found'
])

@section('status-body')
    <p>
        Sorry, we couldn't locate the resource you were looking for.
    </p>
@endsection
