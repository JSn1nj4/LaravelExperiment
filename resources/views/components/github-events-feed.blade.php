<div class="max-w-sm m-auto mb-4" style="min-height: {{ $loaderSize }};">
	<x-timeline :show-line="$count >= 2" line-position-class="w-8">
		@each('partials.github-event-wrapper', $events, 'event')
	</x-timeline>
</div>
