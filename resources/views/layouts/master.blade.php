<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Project</title>

        <link rel="stylesheet" href="/css/app.css">

        @yield('head-extras')
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @include('layouts.header')

            @include('layouts.nav')

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>

        {{-- Footer JS files --}}
        <script src="/js/app.js"></script>

        @yield('footer-extras')
    </body>
</html>
