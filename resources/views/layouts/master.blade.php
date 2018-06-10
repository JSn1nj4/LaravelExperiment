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
        @include('layouts.header')

        @include('layouts.nav')

        <main>
            <div class="container mx-auto px-4">
                @yield('content')
            </div>
        </main>

        @include('layouts.footer')

        {{-- Footer JS files --}}
        <script src="/js/app.js"></script>

        @yield('footer-extras')
    </body>
</html>
