<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <div class="flex flex-row relative">
        <div class="text-grey" :class="icons[event.type]"></div>

        <div class="pl-4 flex-grow relative">
          <p class="text-grey">
            about {{ formattedDate }}
          </p>

          <p class="font-white mt-1">
            <strong>
              <a href="#" target="_blank" class="no-underline">{{ event.actor.display_login }}</a> {{ actions[event.type] }} <a :href="branchUrl" target="_blank" class="no-underline">{{ branchName }}</a> {{ prepositions[event.type] }} <a href="#" target="_blank" class="no-underline">{{ event.repo.name }}</a>
            </strong>
          </p>

          <template v-if="event.type == 'PushEvent'">
            <p v-for="commit in event.payload.commits" :key="commit.sha" class="font-grey align-middle mt-1">
              <a href="#" target="_blank" class="no-underline font-bold">
                <img width="18" height="18" class="align-bottom" :src="tmpAvatarUrl">
              </a> <a href="#" target="_blank" class="no-underline">{{ shortHash(commit.sha) }}</a> {{ shortMsg(commit.message) }}
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
    icons: {
      CreateEvent: 'far fa-plus-square',
      PushEvent: 'far fa-arrow-alt-circle-up',
      DeleteEvent: 'far fa-trash-alt'
    },
    tmpAvatarUrl: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg',
    prepositions: {
      CreateEvent: 'at',
      PushEvent: 'at',
      DeleteEvent: 'from'
    },
    actions: {
      CreateEvent: 'created',
      PushEvent: 'pushed to',
      DeleteEvent: 'deleted'
    },
  }),
  computed: {
    formattedDate() {
      return moment(this.event.created_at).fromNow();
    },
    branchName() {
      return this.event.payload.ref.replace('refs/heads/', '');
    },
    branchUrl() {
      return `${this.event.repo.url}/tree/${this.branchName}`;
    }
  },
  methods: {
    shortMsg(msg) {
      let msgEnd = msg.indexOf('\n');
      return msgEnd >= 0 ? msg.slice(0, msgEnd) : msg;
    },
    shortHash(hash) {
      return hash.slice(0, 6);
    }
  }
}
</script>
