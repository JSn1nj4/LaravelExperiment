@php
    $showLine = !empty($showLine) ? $showLine : true;
    $showDottedLine = !empty($showDottedLine) ? $showDottedLine : false;
    $linePositionClass = !empty($linePositionClass) ? $linePositionClass : 'w-10';
    $commonClasses = "absolute $linePositionClass border-r border-gray-600";
@endphp

<div class="timeline relative mb-4">

    @if($showLine)
        <div class="{{ $commonClasses }} top-0 border-solid h-full">&nbsp;</div>
    @endif

    {{ $slot }}

    @if($showDottedLine)
        <div class="{{ $commonClasses }} bottom-0 border-dashed h-4 -mb-4">&nbsp;</div>
    @endif

</div>
