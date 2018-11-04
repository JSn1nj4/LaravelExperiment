<template>
  <div class="max-w-sm m-auto mb-4" :style="`min-height: ${this.loaderSize}`">

    <timeline :show-line="count >= 2" :line-position-class="'w-8'">
      <loading-animation :size="loaderSize" ref="socketLoader"></loading-animation>

      <git-hub-activity-wrapper v-for="(event, index) in events" :event="event" :key="`gh-event-${index}`"></git-hub-activity-wrapper>
    </timeline>

  </div>
</template>

<script>
import axios from 'axios';
import GitHubActivityWrapper from './components/GitHubActivityWrapper.vue';
import LoadingAnimation from './components/LoadingAnimation.vue';
import Timeline from './components/Timeline.vue';

export default {
  name: "git-hub-activity-feed",
  props: {
    count: {
      default: 7,
      type: Number
    },
    loaderSize: {
      default: '40px',
      type: String
    }
  },

  components: {
    Timeline,
    LoadingAnimation,
    GitHubActivityWrapper
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
