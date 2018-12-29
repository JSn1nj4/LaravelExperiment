<template lang="html">
  <div class="flex flex-row relative">
    <div class="text-grey text-center flex-none github-activity-icon" :class="icon" style="width: 2rem; font-size: 22px;"></div>

    <div class="pl-4 flex-grow relative">
      <p class="text-grey">
        about {{ formattedDate }}
      </p>

      <p class="font-white mt-1 text-sm">
        <strong>
          <a :href="profileUrl" target="_blank" class="no-underline">
            {{ event.actor.display_login }}
          </a>

          {{ action }}

          <template v-if="event.payload.ref_type !== 'repository'">
            <a :href="branchUrl" target="_blank" class="no-underline">
              {{ branchName }}
            </a>

            {{ preposition }}
          </template>

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
  name: "git-hub-create-event",
  mixins: [GitHubActivityMixin],
  data: () => ({
    icon: 'far fa-plus-square',
    action: 'created',
    preposition: 'at'
  })
}
</script>
