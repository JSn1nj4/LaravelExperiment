@extends('layouts.master', ['bodyClasses' => !empty($bodyClasses) ? $bodyClasses : ''])

@section('head-extras')
    @yield('head-extras')
@endsection

@section('body')

    @include('layouts.header', ['menuItems' => []])
    {{-- @include('layouts.header', ['menuItems' => ['home','projects','updates']]) --}}

    <main class="bg-grey-darkest">
        @yield('content')
    </main>

    @include('layouts.footer')

    {{-- Footer JS files --}}
    <script src="/js/app.js"></script>

@endsection

@section('footer-extras')
    @yield('footer-extras')
@endsection
