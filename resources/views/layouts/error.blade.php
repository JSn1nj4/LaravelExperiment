@extends('layouts.page', ['bodyClasses' => 'status-page'])

@section('content')
    <div class="flex">
        <div class="status-code w-1/3 md:pr-4 leading-none">
            {{ $errorCode }}
        </div>

        <div class="status-description w-2/3">
            <h1 class="status-title">
                {{ $errorTitle }}
            </h1>

            <p class="status-message">
                {{ $errorMessage }}
            </p>

            <div class="status-extra-content">
                @yield('extra-content')

                <a href="/">Back to homepage</a>
            </div>
        </div>
    </div>
@endsection
