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

          <a :href="branchUrl" target="_blank">
            {{ branchName }}
          </a>

          {{ preposition }}

          <a :href="repoUrl" target="_blank">
            {{ event.repo.name }}
          </a>

        </strong>
      </p>

      <p v-for="commit in displayCommits" :key="commit.sha" class="font-gray-500 align-middle mt-2">
        <a :href="profileUrl" target="_blank" class="font-bold">
          <img width="18" height="18" class="inline align-bottom" :src="tmpAvatarUrl">
        </a>
        <a :href="commitUrl(commit.sha)" target="_blank">
          {{ shortHash(commit.sha) }}
        </a>
        {{ shortMsg(commit.message) }}
      </p>
      <p v-if="extraCommitsCount > 0" class="font-gray-500 align-middle mt-2">
        <a :href="branchCommitsUrl" target="_blank" class="font-bold">
          +{{extraCommitsCount}} more
        </a>
      </p>

    </div>
  </div>
</template>

<script>
import BaseMixin from '../../mixins/GitHubActivity/BaseMixin';
import BranchesMixin from '../../mixins/GitHubActivity/BranchesMixin';
import CommitsMixin from '../../mixins/GitHubActivity/CommitsMixin';

export default {
  name: "git-hub-push-event",
  mixins: [
    BaseMixin,
    BranchesMixin,
    CommitsMixin,
  ],
  data: () => ({
    icon: 'far fa-arrow-alt-circle-up',
    action: 'pushed to',
    preposition: 'at'
  })
}
</script>
