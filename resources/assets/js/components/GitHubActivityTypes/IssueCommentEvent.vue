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

          <a :href="event.payload.comment.html_url" target="_blank" class="text-sea-green-500">
            {{ issueNumberString }}
          </a>

          {{ preposition }}

          <a :href="repoUrl" target="_blank">
            {{ event.repo.name }}
          </a>

        </strong>
      </p>

      <p class="font-gray-500 align-middle mt-2">
        <a :href="event.payload.comment.user.html_url">
          <img width="18" height="18" class="inline align-bottom" :src="event.payload.comment.user.avatar_url">
        </a>

        {{ issueComment }}
      </p>

    </div>
  </div>
</template>

<script>
import GitHubActivityMixin from '../../mixins/GitHubActivity';

export default {
  name: "git-hub-issue-comment-event",
  mixins: [GitHubActivityMixin],
  data: () => ({
    icon: 'fas fa-comment',
    action: 'commented on',
    preposition: 'at'
  }),
  mounted() {
    if(this.event.payload.action == 'deleted') {
      this.action = 'deleted comment from';
      this.icon = 'fas fa-comment-slash';
    }
  }
}
</script>
