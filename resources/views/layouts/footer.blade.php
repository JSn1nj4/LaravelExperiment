<footer class="w-full pin-b p-3">
    <div class="p-6 text-center text-sea-green">
        <p>Copyright &copy; {{today()->year}} Elliot Derhay</p>
    </div>
    <div class="p-6 pt-0 text-center text-sea-green">
        @include('partials.socials', [
            'classes' => 'text-2xl'
        ])
    </div>
</footer>
