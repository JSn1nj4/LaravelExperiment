@php
    $favicon = "data:image/png;base64,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";
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ElliotDerhay.com</title>

        <link rel="stylesheet" href="/css/app.css">
        <link rel="shortcut icon" href="{{ $favicon }}">

        @yield('head-extras')
    </head>
    <body class="bg-grey-darkest text-white font-mono relative {{ $bodyClasses }}">
        @yield('body')

        @yield('footer-extras')
    </body>
</html>
