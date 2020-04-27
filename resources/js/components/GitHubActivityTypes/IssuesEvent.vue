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

          <a :href="event.payload.issue.html_url" target="_blank" class="text-sea-green-500">
            {{ issueNumberString }}
          </a>

          {{ preposition }}

          <a :href="repoUrl" target="_blank">
            {{ event.repo.name }}
          </a>
        </strong>
      </p>

      <p class="font-gray-500 align-middle mt-2">
        <a :href="event.payload.issue.user.html_url">
          <img width="18" height="18" class="inline align-bottom" :src="event.payload.issue.user.avatar_url">
        </a>

        {{ event.payload.issue.title }}
      </p>

    </div>
  </div>
</template>

<script>
import BaseMixin from '../../mixins/GitHubActivity/BaseMixin';
import IssuesMixin from '../../mixins/GitHubActivity/IssuesMixin';

export default {
  name: "git-hub-issues-event",
  mixins: [
    BaseMixin,
    IssuesMixin,
  ],
  data: () => ({
    icon: 'far fa-file-alt',
    action: 'opened',
    preposition: 'at'
  }),
  mounted() {
    this.action = this.event.payload.action;

    if(this.event.payload.action == 'closed') {
      this.icon = 'fas fa-minus-circle';
    }
  }
}
</script>
