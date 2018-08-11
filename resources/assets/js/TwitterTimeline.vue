<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <timeline :show-line="count >= 2">
      <twitter-card v-for="(tweet, index) in tweets" :tweet="tweet" :key="`tweet-${index}`"></twitter-card>
    </timeline>

  </div>
</template>
<script>
import axios from 'axios';
import TwitterCard from './components/TwitterCard.vue';
import Timeline from './components/Timeline.vue';

export default {
  name: "twitter-timeline",
  props: {
    count: {
      default: 5,
      type: Number
    }
  },

  components: {
    Timeline,
    TwitterCard
  },

  data: () => ({
    tweets: []
  }),

  mounted() {
    axios.get(`/api/tweets/${this.count}`)
      .then(response => {
        this.tweets = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }

}
</script>
