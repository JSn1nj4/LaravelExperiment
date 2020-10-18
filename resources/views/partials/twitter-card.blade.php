@php
  use App\Helpers\Tweet as TwHelpers;

  $profileUrl = TwHelpers::profileUrl($tweet->user->screen_name);
  $tweetUrl = TwHelpers::tweetUrl($profileUrl, $tweet->id_str);
@endphp

<div class="twitter-card">
  @component('partials.card', ['size' => 'sm'])

    <div class="flex flex-row relative">
      <div>
        <a href="{{ $profileUrl }}" target="_blank">
          <img width="48" height="48" src="{{ $tweet->user->profile_image_url_https }}" class="border-solid border-2 border-white rounded-full">
        </a>
      </div>

      <div class="pl-4 flex-grow relative">
        <p>
          <a href="{{ $profileUrl }}" target="_blank" class="font-bold">
            {{ $tweet->user->name }}
          </a><br>
          <a href="{{ $profileUrl }}" target="_blank" class="text-gray-600">
            {{ "@" . $tweet->user->screen_name }}
          </a>
        </p>
      </div>

      <div class="pl-4 flex-none relative">
        <a href="{{ TwHelpers::$baseLink }}" target="_blank">
          <i class="fab fa-twitter text-4xl text-white"></i>
        </a>
      </div>
    </div>

    <div class="pt-4 flex flex-row relative font-bold">
      <p>{!! html_entity_decode(TwHelpers::formatBody($tweet)) !!}</p>
    </div>

    <div class="pt-4 flex flex-row relative">
      <div class="flex-grow">
        <p>
          <a href="{{ $tweetUrl }}" target="_blank" class="font-bold">View on Twitter</a>
        </p>
      </div>

      <div class="pl-4 flex-none relative">
        <p>
          <a href="{{ $tweetUrl }}" target="_blank" class="font-bold">
            {{ TwHelpers::formatDate($tweet->created_at, "d M Y") }}
          </a>
        </p>
      </div>
    </div>

  @endcomponent
</div>
