<div class="github-event-item">
	<x-card size="sm" type="transparent" margin="my-4">
		@include("partials.github-event-types.$type_kebab", [
			'event' => $event
		])
	</x-card>
</div>
