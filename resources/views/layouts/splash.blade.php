@extends('layouts.master', ['bodyClasses' => 'backlight'])

@section('head-extras')
    @yield('head-extras')
@endsection

@section('body')
    @yield('content')
@endsection

@section('footer-extras')
    @yield('footer-extras')
@endsection
