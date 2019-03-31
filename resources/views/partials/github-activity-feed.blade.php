@php
    use App\Http\Controllers\GitHubActivityController;

    $count = !empty($count) ? (int) $count : 7;
    $loaderSize = !empty($loaderSize) ? $loaderSize : '40px';

    $events = json_decode((new GitHubActivityController)->index($count));
@endphp

<div class="max-w-sm m-auto mb-4 -mt-4" style="min-height: {{ $loaderSize }};">
    @component('partials.timeline', [
        'showLine' => ($count >= 2),
        'linePositionClass' => 'w-8'
    ])
        @each('partials.github-activity-wrapper', $events, 'event')
    @endcomponent
    <div class="-mt-4"></div>
</div>
