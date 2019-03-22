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

          <a :href="event.payload.pull_request.html_url" target="_blank" class="no-underline text-sea-green">
            {{ pullRequestNumberString }}
          </a>

          {{ preposition }}

          <a :href="repoUrl" target="_blank" class="no-underline">
            {{ event.repo.name }}
          </a>
        </strong>
      </p>

      <p class="font-grey align-middle mt-2">
        <a :href="event.payload.pull_request.user.html_url">
          <img width="18" height="18" class="inline align-bottom" :src="event.payload.pull_request.user.avatar_url">
        </a>

        {{ event.payload.pull_request.title }}
      </p>

    </div>
  </div>
</template>

<script>
import GitHubActivityMixin from '../../mixins/GitHubActivity';

export default {
  name: "git-hub-pull-request-event",
  mixins: [GitHubActivityMixin],
  data: () => ({
    icon: 'fas fa-file-upload',
    action: 'opened',
    preposition: 'at'
  }),
  computed: {
    profileUrl() {
      return `${this.baseLink}/${this.event.actor.login}`;
    },
    repoUrl() {
      return `${this.baseLink}/${this.event.repo.name}`;
    },
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
