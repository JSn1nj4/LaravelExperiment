<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <div class="flex flex-row relative">
        <div class="text-grey" :class="icons[event.type]"></div>

        <div class="pl-4 flex-grow relative">
          <p class="text-grey">
            about {{ formattedDate }}
          </p>

          <div v-if="event.type == 'CreateEvent'">
            <p class="font-white mt-1">
              <strong>
                <a href="#" target="_blank" class="no-underline">JSn1nj4</a> pushed to <a href="#" target="_blank" class="no-underline">master</a> at <a href="#" target="_blank" class="no-underline">JSn1nj4/ElliotDerhay.com</a>
              </strong>
            </p>
          </div>

          <div v-if="event.type == 'PushEvent'">
            <p class="font-white mt-1">
              <strong>
                <a href="#" target="_blank" class="no-underline">JSn1nj4</a> pushed to <a href="#" target="_blank" class="no-underline">master</a> at <a href="#" target="_blank" class="no-underline">JSn1nj4/ElliotDerhay.com</a>
              </strong>
            </p>

            <!-- Repeat for each commit pushed -->
            <p v-for="commit in event.payload.commits" :key="commit.sha" class="font-grey align-middle mt-1">
              <a href="#" target="_blank" class="no-underline font-bold">
                <img width="18" height="18" class="align-bottom" src="https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg">
              </a> <a href="#" target="_blank" class="no-underline">{{ shortHash(commit.sha) }}</a> {{ shortMsg(commit.message) }}
            </p>
          </div>

          <div v-if="event.type == 'DeleteEvent'">
            <p class="font-white mt-1">
              <strong>
                <a href="#" target="_blank" class="no-underline">JSn1nj4</a> deleted <a href="#" target="_blank" class="no-underline">master</a> from <a href="#" target="_blank" class="no-underline">JSn1nj4/ElliotDerhay.com</a>
              </strong>
            </p>
          </div>


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
      'CreateEvent': 'far fa-plus-square',
      'PushEvent': 'far fa-arrow-alt-circle-up',
      'DeleteEvent': 'far fa-trash-alt'
    }
  }),
  computed: {
    formattedDate() {
      return moment(this.event.created_at).fromNow();
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
  },
  mounted() {
    console.log(this['github-activity']);
  }
}
</script>
