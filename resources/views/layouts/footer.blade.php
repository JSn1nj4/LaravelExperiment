<footer class="container-flexible-large m-auto bottom-0 p-3">
  <div class="p-6 text-center text-sea-green-500">
    <p>Copyright &copy; {{today()->year}} Elliot Derhay</p>
  </div>
  <div class="p-6 pt-0 text-center text-sea-green-500">
    @include('partials.socials', [
      'classes' => 'text-2xl'
    ])
  </div>
</footer>
