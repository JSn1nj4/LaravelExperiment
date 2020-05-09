@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('head-extras')
  @yield('head-extras-pass-thru')
@endsection

@section('body')

  @php
    $menuItems = [];
    $optionalMenuItems = [
      'projects',
      'updates',
    ];

    foreach($optionalMenuItems as $item) {
      if(config("app.enable-" . $item)) $menuItems[] = $item;
    }

    $menuItems[] = 'privacy';

    if(count($menuItems) >= 1) array_unshift($menuItems, 'home');
  @endphp

  @include('layouts.header', $menuItems)

  <main class="bg-gray-800 layer-shadow pt-4 pb-6">
    @yield('content')
  </main>

  @include('layouts.footer')

@endsection

@section('footer-extras')
  {{-- Footer JS files --}}
  <script src="{{ mix('/js/manifest.js') }}"></script>
  <script src="{{ mix('/js/vendor.js') }}"></script>
  <script src="{{ mix('/js/app.js') }}"></script>

  @yield('footer-extras-pass-thru')

  <div id="ga-request-popup" style="display: none;"></div>
  <script src="{{ mix('/js/GAPopup.js') }}" charset="utf-8"></script>

  <script type="application/javascript">
    EventBus.$on('allow_tracking', ga_track);
  </script>
@endsection
