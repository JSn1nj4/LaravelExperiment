@extends('partials.card', [
    'size' => 'sm'
])

@php
    use App\Helpers\Tweet as TwHelpers;

    $baseLink = 'https://twitter.com';
    $profileUrl = TwHelpers::profileUrl('JSn1nj4');
    $tweetUrl = TwHelpers::tweetUrl($profileUrl, $tweet->id_str);
@endphp

<div class="twitter-card">
    @section('card-content')

        <div class="flex flex-row relative">
            <div>
                <a href="{{ $profileUrl }}" target="_blank">
                    <img width="48" height="48" src="{{ $tweet->user->profile_image_url_https }}" class="border-solid border-2 border-white rounded-full">
                </a>
            </div>

            <div class="pl-4 flex-grow relative">
                <p>
                    <a href="{{ $profileUrl }}" target="_blank" class="no-underline font-bold">
                        {{ $tweet->user->name }}
                    </a><br>
                    <a href="{{ $profileUrl }}" target="_blank" class="no-underline text-grey-dark">
                        {{ "@" . $tweet->user->screen_name }}
                    </a>
                </p>
            </div>

            <div class="pl-4 flex-none relative">
                <a href="{{ $baseLink }}" target="_blank">
                    <i class="fab fa-twitter text-4xl text-white"></i>
                </a>
            </div>
        </div>

        <div class="pt-4 flex flex-row relative font-bold">
            <p>{!! TwHelpers::formatBody($tweet) !!}</p>
        </div>

        <div class="pt-4 flex flex-row relative">
            <div class="flex-grow">
                <p>
                    <a href="{{ $tweetUrl }}" target="_blank" class="no-underline font-bold">View on Twitter</a>
                </p>
            </div>

            <div class="pl-4 flex-none relative">
                <p>
                    <a href="{{ $tweetUrl }}" target="_blank" class="no-underline font-bold">
                        {{ TwHelpers::formatDate(new DateTime($tweet->created_at)) }}
                    </a>
                </p>
            </div>
        </div>

    @endsection
</div>
