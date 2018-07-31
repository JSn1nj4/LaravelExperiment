<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <twitter-card v-for="(tweet, index) in tweets" :tweet="tweet" :key="`tweet-${index}`"></twitter-card>

  </div>
</template>
<script>
import axios from 'axios';
import TwitterCard from './components/TwitterCard.vue';

export default {
  name: "tweet",
  props: {
    tweetId: String
  },

  components: {
    TwitterCard
  },

  data: () => ({
    tweets: []
  }),

  mounted() {
    axios.get(`/api/tweet/${this.tweetId}`)
      .then(response => {
        this.tweets = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }

}
</script>
