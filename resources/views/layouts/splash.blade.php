@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('head-extras')
  @yield('head-extras-pass-thru')
@endsection

@section('body')
  @yield('content')
@endsection

@section('footer-extras')
  @yield('footer-extras-pass-thru')
@endsection
