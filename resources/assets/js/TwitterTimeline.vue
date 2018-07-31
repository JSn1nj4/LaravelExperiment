<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <timeline>
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

  components: {
    Timeline,
    TwitterCard
  },

  data: () => ({
    tweets: []
  }),

  mounted() {
    axios.get('/api/tweets')
      .then(response => {
        this.tweets = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }

}
</script>
