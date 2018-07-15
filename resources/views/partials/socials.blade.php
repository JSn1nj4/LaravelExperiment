@php
    $classes = isset($classes) ? $classes : '';
    $linkClasses = isset($linkClasses) ? $linkClasses : '';
@endphp

<p class="{{ $classes }}">
    <a href="https://github.com/JSn1nj4" class="{{ $linkClasses }}" target="_blank"><i class="fab fa-github"></i></a>
    <a href="https://gitlab.com/JSn1nj4" class="{{ $linkClasses }}" target="_blank"><i class="fab fa-gitlab"></i></a>
    <a href="https://twitter.com/JSn1nj4" class="{{ $linkClasses }}" target="_blank"><i class="fab fa-twitter"></i></a>
</p>
