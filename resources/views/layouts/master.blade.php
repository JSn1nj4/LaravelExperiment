<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
    </body>
</html>
