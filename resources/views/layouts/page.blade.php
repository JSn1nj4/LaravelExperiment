@extends('layouts.master')

@section('head-extras')
    @yield('head-extras')
@endsection

@section('body')

    @include('layouts.header')

    <main>
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </main>

    @include('layouts.footer')

    {{-- Footer JS files --}}
    <script src="/js/app.js"></script>

@endsection

@section('footer-extras')
    @yield('footer-extras')
@endsection
