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

          <a :href="this.event.payload.comment.html_url" target="_blank" class="no-underline text-sea-green">
            {{ issueNumberString }}
          </a>

          {{ this.preposition }}

          <a :href="repoUrl" target="_blank" class="no-underline">
            {{ event.repo.name }}
          </a>

        </strong>
      </p>

      <p class="font-grey align-middle mt-2">
        <a :href="event.payload.comment.user.html_url">
          <img width="18" height="18" class="align-bottom" :src="event.payload.comment.user.avatar_url">
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
