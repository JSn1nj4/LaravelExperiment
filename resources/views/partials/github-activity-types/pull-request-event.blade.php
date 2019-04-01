@php
    use App\Helpers\GitHubActivity as GhHelpers;

    // Settings with common names shared with other activity components
    $icon = 'fas fa-file-upload';
    $action = !empty($event->payload->action) ? $event->payload->action : 'opened';
    $preposition = 'at';

    // // Reusable values
    $profileUrl = GhHelpers::profileUrl($event->actor->display_login);
    $repoUrl = GhHelpers::repoUrl($event->repo->name);

    // Modify settings according to PR action and merge status
    switch ($action) {
        case 'assigned':
            break;

        case 'review_requested':
            break;

        case 'review_request_removed':
            break;

        case 'labeled':
            break;

        case 'unlabeled':
            break;

        case 'edited':
            break;

        case 'closed':
            if($event->payload->merged) {
              $action = 'merged';
              $icon = 'fas fa-download';
            } else {
              $icon = 'fas fa-minus-circle';
            }
            break;

        case 'reopened':
            $action = 'reopened';
            break;

        default:
    }
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

                <a href="{{ $event->payload->pull_request->html_url}}" target="_blank" class="text-sea-green-500">
                    {{ GhHelpers::pullRequestNumberString($event->payload->pull_request->number) }}
                </a>

                {{ $preposition }}

                <a href="{{ $repoUrl }}" target="_blank">
                    {{ $event->repo->name }}
                </a>
            </strong>
        </p>

        <p class="font-gray-500 align-middle mt-2">
            <a href="{{ $event->payload->pull_request->user->html_url }}">
                <img width="18" height="18" class="inline align-bottom" src="{{ $event->payload->pull_request->user->avatar_url }}">
            </a>

            {{ $event->payload->pull_request->title }}
        </p>

    </div>
</div>
