@extends('layouts.master', ['bodyClasses' => !empty($bodyClasses) ? $bodyClasses : ''])

@section('head-extras')
    @yield('head-extras')
@endsection

@section('body')

    @include('layouts.header', [
        'menuItems' => [
            'home',
            'about',
            'updates'
        ]
    ])

    <main class="bg-grey-darkest layer-shadow pt-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    {{-- Footer JS files --}}
    <script src="/js/app.js"></script>

@endsection

@section('footer-extras')
    @yield('footer-extras')
@endsection
