<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

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

              <a :href="this.event.payload.issue.html_url" target="_blank" class="no-underline text-sea-green">
                {{ issueNumberString }}
              </a>

              {{ this.preposition }}

              <a :href="repoUrl" target="_blank" class="no-underline">
                {{ event.repo.name }}
              </a>
            </strong>
          </p>

          <p class="font-grey align-middle mt-2">
            <a :href="event.payload.issue.user.html_url">
              <img width="18" height="18" class="align-bottom" :src="event.payload.issue.user.avatar_url">
            </a>

            {{ event.payload.issue.title }}
          </p>

        </div>
      </div>

    </card>
  </div>
</template>

<script>
import moment from 'moment';
import Card from './Card.vue';

export default {
  name: "git-hub-activity-item",
  components: {
    Card
  },
  props: {
    event: Object
  },
  data: () => ({
    baseLink: 'https://github.com',
    icon: 'far fa-file-alt',
    action: 'opened',
    preposition: 'at',
    tmpAvatarUrl: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg',
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
    if(this.event.type == 'IssuesEvent') {
      this.IssuesEvent.action = this.event.payload.action;
    }

    if(this.event.type == 'IssuesEvent' && this.event.payload.action == 'closed') {
      this.IssuesEvent.icon = 'fas fa-minus-circle';
    }
  }
}
</script>
<style lang="scss">
  .github-activity-icon {
    &:before {
      background: #151515;
    }
  }
</style>
