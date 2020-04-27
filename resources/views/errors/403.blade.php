@extends('layouts.error', [
    'errorCode' => '403',
    'errorTitle' => $exception->getMessage() ?? 'Forbidden'
])

@section('status-body')
    <p>
        Sorry, but you're not authorized to view this resource.
    </p>
@endsection

@section('status-footer')
    <p>
        <a href="{{ route('home') }}">Back to homepage</a>
    </p>
@endsection
