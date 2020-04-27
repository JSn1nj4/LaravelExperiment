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

          <a :href="repoUrl" target="_blank">
            {{ event.repo.name }}
          </a>

        </strong>
      </p>

    </div>
  </div>
</template>

<script>
import BaseMixin from '../../mixins/GitHubActivity/BaseMixin';

export default {
  name: "git-hub-activity-item",
  mixins: [BaseMixin],
  data: () => ({
    icon: 'fas fa-star',
    action: 'starred'
  })
}
</script>
