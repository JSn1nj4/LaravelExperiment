@php
  // Size and type defaults
  $size = $size ?? 'sm';
  $type = $type ?? 'default';

  // Decide what $margin would be set to
  if(!isset($margin) && $type === 'transparent') {
    $margin = '';
  } else {
    $margin = $margin ?? 'my-4';
  }

  // Decide what $padding would be set to
  if(!isset($padding) && $type === 'transparent') {
    $padding = 'px-4';
  } else {
    $padding = $padding ?? 'p-4';
  }

  // Classes to be used for different types of 'cards'
  $typeClasses = [
    'default' => 'rounded-lg border border-gray-600 trans-border-color hover:border-sea-green-500 bg-gray-900',
    'transparent' => ''
  ];

  // Final class string
  $classes = "relative $margin max-w-$size w-full z-30 $padding $typeClasses[$type]";
@endphp

<div class="{{ $classes }}">
  {{ $slot }}
</div>
