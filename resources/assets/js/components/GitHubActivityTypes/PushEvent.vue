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

              <a :href="branchUrl" target="_blank" class="no-underline">
                {{ branchName }}
              </a>

              {{ this.preposition }}

              <a v-else :href="repoUrl" target="_blank" class="no-underline">
                {{ event.repo.name }}
              </a>

            </strong>
          </p>

          <p v-for="commit in displayCommits" :key="commit.sha" class="font-grey align-middle mt-2">
            <a :href="profileUrl" target="_blank" class="no-underline font-bold">
              <img width="18" height="18" class="align-bottom" :src="tmpAvatarUrl">
            </a>
            <a :href="commitUrl(commit.sha)" target="_blank" class="no-underline">
              {{ shortHash(commit.sha) }}
            </a>
            {{ shortMsg(commit.message) }}
          </p>
          <p v-if="extraCommitsCount > 0" class="font-grey align-middle mt-2">
            <a :href="branchCommitsUrl" target="_blank" class="no-underline font-bold">
              +{{extraCommitsCount}} more
            </a>
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
    icon: 'far fa-arrow-alt-circle-up',
    action: 'pushed to',
    preposition: 'at',
    WatchEvent: {
      icon: 'fas fa-star',
      action: 'starred'
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
    branchCommitsUrl() {
      return `${this.repoUrl}/commits/${this.branchName}`;
    },
    displayCommits() {
      let commits = this.event.payload.commits;
      return commits.length > 4 ? commits.slice(0, 4) : commits;
    },
    extraCommitsCount() {
      let commits = this.event.payload.commits;
      return commits.length > 4 ? commits.length - 4 : 0;
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
}
</script>
<style lang="scss">
  .github-activity-icon {
    &:before {
      background: #151515;
    }
  }
</style>
