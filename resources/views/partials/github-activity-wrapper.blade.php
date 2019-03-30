<div class="github-activity-item">
    @component('partials.card', [
        'size' => 'sm',
        'type' => 'transparent'
    ])
        @include("partials.GitHubActivityTypes.$event->type", [
            'event' => $event
        ])
    @endcomponent
</div>
