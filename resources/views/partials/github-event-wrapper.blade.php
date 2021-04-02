@php
	use App\Helpers\GlobalHelpers;
	$type = GlobalHelpers::stringToKebabCase($event->type);
@endphp

<div class="github-event-item">
	<x-card size="sm" type="transparent" margin="my-4">
		@include("partials.github-event-types.$type", [
			'event' => $event
		])
	</x-card>
</div>
