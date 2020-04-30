@extends('layouts.error', [
    'errorCode' => '503',
    'errorTitle' => $exception->getMessage() ?? 'Service Unavailable'
])

@section('status-body')
    <p>
        This site is down for maintenance. Please check back later.
    </p>
@endsection
