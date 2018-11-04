@extends('layouts.master', ['bodyClasses' => !empty($bodyClasses) ? $bodyClasses : ''])

@section('head-extras')
    @yield('head-extras')
@endsection

@section('body')

    @php
        $menuItems = [
            'home',
            'about'
        ];

        if(config('app.env') === 'local') {
            array_push($menuItems, 'updates');
        }
    @endphp

    @include('layouts.header', $menuItems)

    <main class="bg-grey-darkest layer-shadow pt-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    {{-- Footer JS files --}}
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection

@section('footer-extras')
    @yield('footer-extras')
@endsection
