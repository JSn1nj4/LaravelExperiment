<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <twitter-card v-if="tweet" :tweet="tweet"></twitter-card>

  </div>
</template>
<script>
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
    tweet: undefined
  }),

  mounted() {
    axios.get(`/api/tweet/${this.tweetId}`)
      .then(response => {
        this.tweet = Array.isArray(response.data) ? response.data[0] : response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }

}
</script>
