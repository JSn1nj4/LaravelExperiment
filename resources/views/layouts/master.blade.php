<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ElliotDerhay.com</title>

        <link rel="stylesheet" href="/css/app.css">

        @yield('head-extras')
    </head>
    <body class="bg-grey-darkest text-white font-mono {{ $bodyClasses }}">
        @yield('body')

        @yield('footer-extras')
    </body>
</html>
