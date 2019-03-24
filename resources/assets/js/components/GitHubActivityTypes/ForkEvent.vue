<template>
  <div class="flex flex-row relative">
    <div class="text-gray-500 text-center flex-none github-activity-icon" :class="icon" style="width: 2rem; font-size: 22px;"></div>

    <div class="pl-4 flex-grow relative">
      <p class="text-gray-500">
        about {{ formattedDate }}
      </p>

      <p class="font-white mt-1 text-sm">
        <strong>
          <a :href="profileUrl" target="_blank">
            {{ event.actor.display_login }}
          </a>

          {{ action }}

          <a :href="repoUrl" target="_blank" class="text-sea-green-500">
            {{ event.repo.name }}
          </a>

          {{ preposition }}

          <a :href="event.payload.forkee.html_url" target="_blank">
            {{ event.payload.forkee.full_name }}
          </a>

        </strong>
      </p>

    </div>
  </div>
</template>

<script>
import GitHubActivityMixin from '../../mixins/GitHubActivity';

export default {
  name: "git-hub-fork-event",
  mixins: [GitHubActivityMixin],
  data: () => ({
    icon: 'fas fa-code-branch',
    action: 'forked',
    preposition: 'into'
  })
}
</script>
