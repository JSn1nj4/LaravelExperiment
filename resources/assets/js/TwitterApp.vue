<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <timeline>
      <twitter-card v-for="(tweet, index) in tweets" :tweet="tweet" :key="`tweet-${index}`"></twitter-card>
    </timeline>

  </div>
</template>
<script>
import TwitterCard from './components/TwitterCard.vue';
import Timeline from './components/Timeline.vue';

export default {
  name: "twitter-app",

  components: {
    Timeline,
    TwitterCard
  },

  data: () => ({
    tweets: [
      {
        user: {
          avatar: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
          name: 'Elliot Derhay',
          handle: '@JSn1nj4',
          profile: 'https://twitter.com/JSn1nj4/'
        },
        blurb: 'Twitter has some nice keyboard shortcuts. \`Shift+?\`',
        link: 'https://twitter.com/JSn1nj4/status/989678620598853635'
      }
    ],
    baseLink: 'https://twitter.com/'
  })

}
</script>
