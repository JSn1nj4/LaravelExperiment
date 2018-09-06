<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <div class="flex flex-row relative">
        <div class="text-grey text-center flex-none github-activity-icon" :class="this[event.type].icon" style="width: 2rem; font-size: 22px;"></div>

        <div class="pl-4 flex-grow relative">
          <p class="text-grey">
            about {{ formattedDate }}
          </p>

          <p class="font-white mt-1 text-sm">
            <strong>
              <a :href="profileUrl" target="_blank" class="no-underline">
                {{ event.actor.display_login }}
              </a>

              {{ this[event.type].action }}

              <a v-if="event.type == 'IssuesEvent'" :href="this.event.payload.issue.html_url" target="_blank" class="no-underline text-sea-green">
                {{ issueNumberString }}
              </a>
              <a v-else-if="event.type == 'IssueCommentEvent'" :href="this.event.payload.comment.html_url" target="_blank" class="no-underline text-sea-green">
                {{ issueNumberString }}
              </a>
              <span v-else-if="event.type == 'DeleteEvent'" class="no-underline text-sea-green-darker">
                {{ branchName }}
              </span>
              <a v-else :href="branchUrl" target="_blank" class="no-underline">
                {{ branchName }}
              </a>

              {{ this[event.type].preposition }}

              <a :href="repoUrl" target="_blank" class="no-underline">
                {{ event.repo.name }}
              </a>
            </strong>
          </p>

          <template v-if="event.type == 'PushEvent'">
            <p v-for="commit in event.payload.commits" :key="commit.sha" class="font-grey align-middle mt-2">
              <a :href="profileUrl" target="_blank" class="no-underline font-bold">
                <img width="18" height="18" class="align-bottom" :src="tmpAvatarUrl">
              </a>
              <a :href="commitUrl(commit.sha)" target="_blank" class="no-underline">
                {{ shortHash(commit.sha) }}
              </a>
              {{ shortMsg(commit.message) }}
            </p>
          </template>
          <template v-else-if="event.type == 'IssuesEvent'">
            <p class="font-grey align-middle mt-2">
              <a :href="event.payload.issue.user.html_url">
                <img width="18" height="18" class="align-bottom" :src="event.payload.issue.user.avatar_url">
              </a>

              {{ event.payload.issue.title }}
            </p>
          </template>
          <template v-else-if="event.type == 'IssueCommentEvent'">
            <p class="font-grey align-middle mt-2">
              <a :href="event.payload.comment.user.html_url">
                <img width="18" height="18" class="align-bottom" :src="event.payload.comment.user.avatar_url">
              </a>

              {{ issueComment }}
            </p>
          </template>

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
    CreateEvent: {
      icon: 'far fa-plus-square',
      action: 'created',
      preposition: 'at'
    },
    PushEvent: {
      icon: 'far fa-arrow-alt-circle-up',
      action: 'pushed to',
      preposition: 'at'
    },
    DeleteEvent: {
      icon: 'far fa-trash-alt',
      action: 'deleted',
      preposition: 'from'
    },
    IssuesEvent: {
      icon: 'far fa-file-alt',
      action: 'opened',
      preposition: 'at'
    },
    IssueCommentEvent: {
      icon: 'fas fa-comment',
      action: 'commented on',
      preposition: 'at'
    },
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
    branchName() {
      return this.event.payload.ref.replace('refs/heads/', '');
    },
    branchUrl() {
      return `${this.repoUrl}/tree/${this.branchName}`;
    },
    issueNumberString() {
      return `Issue #${this.event.payload.issue.number}`;
    },
    issueComment() {
      let body = this.event.payload.comment.body;
      let limit = 280;
      return (body.length > limit) ? body.slice(0, 280).slice(0, body.lastIndexOf(' ')) + '...' : body;
    }
  },
  methods: {
    shortMsg(msg) {
      let msgEnd = msg.indexOf('\n');
      return msgEnd >= 0 ? msg.slice(0, msgEnd) : msg;
    },
    shortHash(hash) {
      return hash.slice(0, 6);
    },
    commitUrl(hash) {
      return `${this.repoUrl}/commit/${hash}`;
    }
  },
  mounted() {
    if(this.event.type == 'IssuesEvent') {
      this.IssuesEvent.action = this.event.payload.action;
    }

    if(this.event.type == 'IssuesEvent' && this.event.payload.action == 'closed') {
      this.IssuesEvent.icon = 'fas fa-minus-circle';
    }

    if(this.event.type == 'IssueCommentEvent' && this.event.payload.action == 'deleted') {
      this.IssueCommentEvent.action = 'deleted comment from';
      this.IssueCommentEvent.icon = 'fas fa-comment-slash';
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
