@php
    use App\Http\Controllers\TweetController;

    $count = !empty($count) ? (int) $count : 5;
    $loaderSize = !empty($loaderSize) ? $loaderSize : '40px';

    $tweets = json_decode((new TweetController)->index($count));
@endphp

<div class="max-w-sm m-auto mb-4 -mt-4" style="min-height: {{ $loaderSize }}">
    @component('partials.timeline', ['showLine' => ($count >= 2)])
        @each('partials.twitter-card', $tweets, 'tweet')
    @endcomponent
    <div class="-mt-4"></div>
</div>
