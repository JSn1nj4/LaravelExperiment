<template>
  <div class="twitter-card">

    <card :size="'sm'" :url="tweet.link">

      <div class="flex flex-row relative">
        <div>
          <a :href="tweet.user.profile" target="_blank" @click.stop>
            <img width="48" height="48" :src="tweet.user.avatar" class="border-solid border-2 border-white rounded-full" @click.stop>
          </a>
        </div>

        <div class="pl-4 flex-grow relative">
          <p>
            <a :href="tweet.user.profile" target="_blank" class="no-underline font-bold" @click.stop>
              {{ tweet.user.name }}
            </a><br>
            <a :href="tweet.user.profile" target="_blank" class="no-underline text-grey-dark" @click.stop>
              {{ tweet.user.handle }}
            </a>
          </p>
        </div>

        <div class="pl-4 flex-none relative">
          <a :href="baseLink" target="_blank" @click.stop>
            <i class="fab fa-twitter text-4xl text-white" @click.stop></i>
          </a>
        </div>
      </div>

      <div class="pt-4 flex flex-row relative font-bold">
        <p @click.stop>{{ tweet.blurb }}</p>
      </div>

      <div class="pt-4 flex flex-row relative">
        <div class="flex-grow">
          <p>
            <a class="no-underline font-bold" :href="tweet.link" target="_blank" @click.stop>View on Twitter</a>
          </p>
        </div>

        <div class="pl-4 flex-none relative">
          <p>
            <a class="no-underline font-bold" :href="tweet.link" target="_blank" @click.stop>
              {{formatDate(tweet.created_at)}}
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
  name: "twitter-card",
  components: {
    Card
  },
  props: {
    tweet: Object
  },
  data: () => ({
    baseLink: 'https://twitter.com/'
  }),
  methods: {
    formatDate(created_at) {
      return moment(created_at).local().format('D MMM YYYY');
    }
  }
}
</script>
<style lang="scss">
  .twitter-card {
    font-family: "Helvetica Neue", "Segoe UI", Helvetica, Arial, sans-serif;
  }
</style>
