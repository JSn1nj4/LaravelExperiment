<template>
  <div class="max-w-sm m-auto mb-4" :style="`min-height: ${this.loaderSize}`">

    <timeline :show-line="count >= 2">
      <loading-animation :size="loaderSize" ref="socketLoader"></loading-animation>

      <git-hub-activity-item v-for="(event, index) in events" :event="event" :key="`gh-event-${index}`"></git-hub-activity-item>
    </timeline>

  </div>
</template>

<script>
import axios from 'axios';
import GitHubActivityItem from './components/GitHubActivityItem.vue';
import LoadingAnimation from './components/LoadingAnimation.vue';
import Timeline from './components/Timeline.vue';

export default {
  name: "git-hub-activity-feed",
  props: {
    count: {
      default: 5,
      type: Number
    },
    loaderSize: {
      default: '80px',
      type: String
    }
  },

  components: {
    Timeline,
    LoadingAnimation,
    GitHubActivityItem
  },

  data: () => ({
    events: []
  }),

  mounted() {
    axios.get(`/api/github/activity/${this.count}`)
      .then(response => {
        this.events = response.data;
        this.$refs.socketLoader.fadeOut();
      })
      .catch(error => {
        console.error(error);
      });
  }
}
</script>
