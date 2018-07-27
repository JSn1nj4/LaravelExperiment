<template>
  <div id="twitter-app" class="max-w-sm m-auto pb-4">

    <timeline>
      <card v-for="(tweet, index) in tweets" :size="'sm'" :url="tweet.link" :key="`tweet-${index}`">

        <div class="flex flex-row relative">
          <div>
            <a :href="tweet.user.profile" target="_blank" @click.stop>
              <img width="48" height="48" :src="tweet.user.avatar" class="border-solid border-2 border-white rounded-full" @click.stop>
            </a>
          </div>

          <div class="pl-4 flex-grow relative">
            <p>
              <a :href="tweet.user.profile" target="_blank" class="no-underline" @click.stop>
                {{ tweet.user.name }}
              </a><br>
              <a :href="tweet.user.profile" target="_blank" class="no-underline text-grey-dark" @click.stop>
                {{ tweet.user.handle }}
              </a>
            </p>
          </div>

          <div class="pl-4 flex-none relative">
            <a :href="baseLink" target="_blank" @click.stop>
              <i class="fab fa-twitter text-3xl text-white" @click.stop></i>
            </a>
          </div>
        </div>

        <div class="pt-4 flex flex-row relative">
          <p>{{ tweet.blurb }}</p>
        </div>

        <div class="pt-4 flex flex-row relative">
          <div class="flex-grow">
            <p class="text-sea-green">
              <i class="far fa-comment hover:text-white trans-color"></i>
              <i class="fas fa-retweet hover:text-white trans-color"></i>
              <i class="far fa-heart hover:text-white trans-color"></i>
            </p>
          </div>

          <div class="pl-4 flex-none relative">
            <p class="text-sea-green" @click.stop>26 Apr 2018</p>
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
