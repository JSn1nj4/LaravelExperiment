<template lang="html">
  <div class="flex flex-row relative">
    <div class="text-grey text-center flex-none github-activity-icon" :class="this.icon" style="width: 2rem; font-size: 22px;"></div>

    <div class="pl-4 flex-grow relative">
      <p class="text-grey">
        about {{ formattedDate }}
      </p>

      <p class="font-white mt-1 text-sm">
        <strong>
          <a :href="profileUrl" target="_blank" class="no-underline">
            {{ event.actor.display_login }}
          </a>

          {{ this.action }}

          <a :href="repoUrl" target="_blank" class="no-underline">
            {{ event.repo.name }}
          </a>

        </strong>
      </p>

    </div>
  </div>
</template>

<script>
import GitHubActivityMixin from '../../mixins/GitHubActivity';

export default {
  name: "git-hub-activity-item",
  mixins: [GitHubActivityMixin],
  data: () => ({
    icon: 'fas fa-star',
    action: 'starred'
  })
}
</script>
