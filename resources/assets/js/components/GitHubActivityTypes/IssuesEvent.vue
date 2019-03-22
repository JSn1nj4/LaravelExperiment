<template>
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

          <a :href="event.payload.issue.html_url" target="_blank" class="no-underline text-sea-green">
            {{ issueNumberString }}
          </a>

          {{ preposition }}

          <a :href="repoUrl" target="_blank" class="no-underline">
            {{ event.repo.name }}
          </a>
        </strong>
      </p>

      <p class="font-grey align-middle mt-2">
        <a :href="event.payload.issue.user.html_url">
          <img width="18" height="18" class="inline align-bottom" :src="event.payload.issue.user.avatar_url">
        </a>

        {{ event.payload.issue.title }}
      </p>

    </div>
  </div>
</template>

<script>
import GitHubActivityMixin from '../../mixins/GitHubActivity';

export default {
  name: "git-hub-issues-event",
  mixins: [GitHubActivityMixin],
  data: () => ({
    icon: 'far fa-file-alt',
    action: 'opened',
    preposition: 'at'
  }),
  computed: {
    formattedDate() {
      return moment(this.event.created_at).fromNow();
    },
    profileUrl() {
      return `${this.baseLink}/${this.event.actor.login}`;
    },
    repoUrl() {
      return `${this.baseLink}/${this.event.repo.name}`;
    },
    issueNumberString() {
      return `Issue #${this.event.payload.issue.number}`;
    },
  },
  mounted() {
    this.action = this.event.payload.action;

    if(this.event.payload.action == 'closed') {
      this.icon = 'fas fa-minus-circle';
    }
  }
}
</script>
