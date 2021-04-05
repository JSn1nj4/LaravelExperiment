<div class="timeline relative mb-4">

	@if($showLine)
		<div class="{{ $commonClasses }} top-0 border-solid h-full">&nbsp;</div>
	@endif

	{{ $slot }}

	@if($showDottedLine)
		<div class="{{ $commonClasses }} bottom-0 border-dashed h-4 -mb-4">&nbsp;</div>
	@endif

</div>
