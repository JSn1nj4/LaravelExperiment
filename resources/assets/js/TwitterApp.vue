<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <timeline>
      <card v-for="(tweet, index) in tweets" :size="'sm'" :url="tweet.link" :key="`tweet-${index}`">

        <div class="flex flex-row">
          <div>
            <a :href="tweet.link" target="_blank">
              <img width="48" height="48" :src="tweet.icon" class="border-solid border-2 border-white rounded-full">
            </a>
          </div>

          <div class="pl-4 flex-grow">
            <p>
              <a :href="tweet.link" target="_blank" class="no-underline">
                {{ tweet.name }}
              </a><br>
              <a :href="tweet.link" target="_blank" class="no-underline text-grey-dark">
                {{ tweet.username }}
              </a>
            </p>
          </div>

          <div class="pl-4 flex-none">
            <a href="https://twitter.com">
              <i class="fab fa-twitter text-4xl text-white"></i>
            </a>
          </div>
        </div>

        <div class="pt-4 flex flex-row">
          <p>{{ tweet.blurb }}</p>
        </div>

        <div class="pt-4 flex flex-row">
          <div class="flex-grow">
            <p class="text-sea-green">
              <i class="far fa-comment"></i>
              <i class="fas fa-retweet"></i>
              <i class="far fa-heart"></i>
            </p>
          </div>

          <div class="pl-4 flex-none">
            <p class="text-sea-green">26 Apr 2018</p>
          </div>
        </div>

      </card>
    </timeline>

  </div>
</template>
<script>
import Card from './components/Card.vue';
import Timeline from './components/Timeline.vue';

export default {
  name: "twitter-app",

  components: {
    Timeline,
    Card
  },

  data: () => ({
    tweets: [
      {
        icon: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
        name: 'Elliot Derhay',
        username: '@JSn1nj4',
        blurb: 'Twitter has some nice keyboard shortcuts. \`Shift+?\`',
        link: 'https://twitter.com/JSn1nj4/status/989678620598853635'
      }
    ]
  })

}
</script>
