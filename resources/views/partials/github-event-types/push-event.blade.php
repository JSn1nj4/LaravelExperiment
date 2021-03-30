@php
  use App\Helpers\GithubEventHelpers as GhHelpers;

  // Settings with common names shared with other GitHub event components
  $icon = 'far fa-arrow-alt-circle-up';
  $action = $event->action ?? 'pushed to';
  $preposition = 'at';

  // Reusable values
  $profileUrl = GhHelpers::profileUrl($event->user->display_login);
  $repoUrl = GhHelpers::repoUrl($event->repo);
  $branchName = GhHelpers::branchName($event->source);
@endphp

<div class="flex flex-row relative">
  <div class="text-gray-500 text-center flex-none github-event-icon {{ $icon }}" style="width: 2rem; font-size: 22px;"></div>

  <div class="pl-4 flex-grow relative">
    <p class="text-gray-500">
      {{ GhHelpers::timeElapsedString($event->date) }}
    </p>

    <p class="font-white mt-1 text-sm leading-none">
      <strong>
        <a href="{{ $profileUrl }}" target="_blank">
          {{ $event->user->display_login }}
        </a>

        {{ $action }}

        <a href="{{ GhHelpers::branchUrl($repoUrl, $branchName) }}" target="_blank">
          {{ $branchName }}
        </a>

        {{ $preposition }}

        <a href="{{ $repoUrl }}" target="_blank">
          {{ $event->repo }}
        </a>
      </strong>
    </p>
  </div>
</div>
