<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#090909">

		<title>Admin Dashboard | ElliotDerhay.com</title>

		<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
		<script src="https://kit.fontawesome.com/a9f488e9e4.js" crossorigin="anonymous"></script>

		<link rel="shortcut icon" href="https://s3.amazonaws.com/elliotderhay-com/favicon.png">

		@yield('head-extras')
	</head>
	<body class="bg-gray-900 text-white font-mono relative">
		@yield('body')

		@yield('footer-extras')
	</body>
</html>