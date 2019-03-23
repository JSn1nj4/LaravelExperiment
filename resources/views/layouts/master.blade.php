<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#090909">

        <title>ElliotDerhay.com</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

        <link rel="shortcut icon" href="https://s3.amazonaws.com/elliotderhay-com/favicon.png">

        @yield('head-extras')
    </head>
    <body class="bg-gray-900 text-white font-mono relative {{ $bodyClasses }}">
        @yield('body')

        @yield('footer-extras')
    </body>
</html>
