@extends('layouts.master', ['bodyClasses' => !empty($bodyClasses) ? $bodyClasses : ''])

@section('head-extras')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    @yield('head-extras')
@endsection

@section('body')

    @include('layouts.header', ['menuItems' => []])
    {{-- @include('layouts.header', ['menuItems' => ['home','projects','updates']]) --}}

    <main>
        <div class="container mx-auto px-4 pt-6">
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
