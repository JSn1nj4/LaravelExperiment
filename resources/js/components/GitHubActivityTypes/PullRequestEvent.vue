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

          <a :href="event.payload.pull_request.html_url" target="_blank" class="text-sea-green-500">
            {{ pullRequestNumberString }}
          </a>

          {{ preposition }}

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
  name: "git-hub-pull-request-event",
  mixins: [BaseMixin],
  data: () => ({
    icon: 'fas fa-file-upload',
    action: 'opened',
    preposition: 'at'
  }),
  computed: {
    pullRequestNumberString() {
      return `Pull Request #${this.event.payload.pull_request.number}`;
    },
  },
  mounted() {
    this.action = this.event.payload.action;

    switch (this.event.payload.action) {
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
        if(this.event.payload.merged) {
          this.action = 'merged';
          this.icon = 'fas fa-download';
        } else {
          this.icon = 'fas fa-minus-circle';
        }
        break;

      case 'reopened':

        break;

      default:

    }
  }
}
</script>
