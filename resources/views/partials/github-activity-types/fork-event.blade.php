@php
  use App\Helpers\GitHubActivity as GhHelpers;

  // Settings with common names shared with other activity components
  $icon = 'fas fa-code-branch';
  $action = $event->action ?? 'forked';
  $preposition = 'into';

  // Reusable values
  $profileUrl = GhHelpers::profileUrl($event->user->display_login);
  $repoUrl = GhHelpers::repoUrl($event->repo);
@endphp

<div class="flex flex-row relative">
  <div class="text-gray-500 text-center flex-none github-activity-icon {{ $icon }}" style="width: 2rem; font-size: 22px;"></div>

  <div class="pl-4 flex-grow relative">
    <p class="text-gray-500">
      {{ GhHelpers::timeElapsedString($event->date) }}
    </p>

    <p class="font-white mt-1 text-sm">
      <strong>
        <a href="{{ $profileUrl }}" target="_blank">
          {{ $event->user->display_login }}
        </a>

        {{ $action }}

        <a href="{{ $repoUrl }}" target="_blank" class="text-sea-green-500">
          {{ $event->repo }}
        </a>

        {{ $preposition }}

        <a href="https://github.com/{{ $event->source }}" target="_blank">
          {{ $event->source }}
        </a>
      </strong>
    </p>

  </div>
</div>
