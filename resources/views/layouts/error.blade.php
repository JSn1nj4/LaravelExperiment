@extends('layouts.splash', ['bodyClasses' => 'status-page'])

@section('content')
  <div class="flex flex-col mx-auto container max-h-screen h-screen px-4 py-6 justify-center">
    <div class="pb-4 w-full max-w-md mx-auto">
      <h1 class="text-4xl">
        <span class="align-middle text-6xl">{{ $errorCode }}</span>
        <span class="inline-block align-middle w-0 h-16 border-solid border-r-2 border-sea-green-500">&nbsp;</span>
        <span class="align-middle leading-none">{{ $errorTitle }}</span>
      </h1>

      <div class="pt-4 text-lg leading-normal font-thin">
        @yield('status-body')
      </div>

      <div class="pt-4">
        @yield('status-footer')
      </div>
    </div>
  </div>
@endsection
