@php
  use App\Helpers\GitHubActivity as GhHelpers;

  // Settings with common names shared with other activity components
  $icon = 'fas fa-star';
  $action = 'starred';

  // Reusable values
  $profileUrl = GhHelpers::profileUrl($event->actor->display_login);
  $repoUrl = GhHelpers::repoUrl($event->repo->name);
@endphp

<div class="flex flex-row relative">
  <div class="text-gray-500 text-center flex-none github-activity-icon {{ $icon }}" style="width: 2rem; font-size: 22px;"></div>

  <div class="pl-4 flex-grow relative">
    <p class="text-gray-500">
      {{ GhHelpers::timeElapsedString($event->created_at) }}
    </p>

    <p class="font-white mt-1 text-sm">
      <strong>
        <a href="{{ $profileUrl }}" target="_blank">
          {{ $event->actor->display_login }}
        </a>

        {{ $action }}

        <a href="{{ $repoUrl }}" target="_blank">
          {{ $event->repo->name }}
        </a>

      </strong>
    </p>

  </div>
</div>
