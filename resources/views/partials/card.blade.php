@php
    $size = !empty($size) ? $size : 'sm';
    $type = !empty($type) ? $type : 'default';

    $typeClasses = [
        'default': 'p-4 rounded-lg border border-grey-dark trans-border-color hover:border-sea-green bg-black',
        'transparent': 'px-4'
    ];

    $classes = "relative my-4 max-w-$size w-full z-30 $typeClasses[$type]"
@endphp

<div class="{{ $classes }}">
    @yield('card-content')
</div>
