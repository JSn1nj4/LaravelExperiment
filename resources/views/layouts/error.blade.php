@extends('layouts.page')

@section('content')
    <div class="status-code">
        {{ $errorCode }}
    </div>

    <div class="status-message">
        <div class="status-title">
            {{ $errorTitle }}
        </div>

        <div class="status-message">
            {{ $errorMessage }}
        </div>

        <div class="status-extra-content">
            @yield('extra-content')
        </div>
    </div>
@endsection
