@php
  use App\Helpers\GlobalHelpers;
  $type = GlobalHelpers::stringToKebabCase($event->type);
@endphp

<div class="github-activity-item">
  @component('partials.card', [
    'size' => 'sm',
    'type' => 'transparent'
  ])
    @include("partials.github-activity-types.$type", [
      'event' => $event
    ])
  @endcomponent
</div>
