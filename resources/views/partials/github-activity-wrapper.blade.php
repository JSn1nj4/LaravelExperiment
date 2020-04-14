@php
  use App\Helpers\GlobalHelpers;
  $type = GlobalHelpers::stringToKebabCase($event->type);
@endphp

<div class="github-activity-item">
  @component('partials.card', [
    'size' => 'sm',
    'type' => 'transparent',
    'margin' => 'my-4'
  ])
    @include("partials.github-activity-types.$type", [
      'event' => $event
    ])
  @endcomponent
</div>
