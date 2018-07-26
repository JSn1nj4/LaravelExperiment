<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <timeline>
      <card v-for="(tweet, index) in tweets" :size="'sm'" :url="tweet.link" :key="`tweet-${index}`">

        <div class="flex-none">
          <a :href="tweet.link" target="_blank">
            <img width="48" height="48" :src="tweet.icon" class="border-solid border-2 border-white rounded-full">
          </a>
        </div>

        <div class="pl-4 flex flex-col">
          <p>
            <a :href="tweet.link" target="_blank" class="no-underline">
              {{ tweet.name }}
            </a>
            <a :href="tweet.link" target="_blank" class="no-underline text-grey-dark">
              {{ tweet.username }}
            </a>
          </p>
          <p class="pt-3">{{ tweet.blurb }}</p>
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
