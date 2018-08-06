<template>
  <div class="twitter-card">

    <card :size="'sm'" :url="tweet_url">

      <div class="flex flex-row relative">
        <div>
          <a :href="profile_url" target="_blank" @click.stop>
            <img width="48" height="48" :src="tweet.user.profile_image_url_https" class="border-solid border-2 border-white rounded-full" @click.stop>
          </a>
        </div>

        <div class="pl-4 flex-grow relative">
          <p>
            <a :href="profile_url" target="_blank" class="no-underline font-bold" @click.stop>
              {{ tweet.user.name }}
            </a><br>
            <a :href="profile_url" target="_blank" class="no-underline text-grey-dark" @click.stop>
              @{{ tweet.user.screen_name }}
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
        <p @click.stop v-html="formattedText(tweet.text)"></p>
      </div>

      <div class="pt-4 flex flex-row relative">
        <div class="flex-grow">
          <p>
            <a class="no-underline font-bold" :href="tweet_url" target="_blank" @click.stop>View on Twitter</a>
          </p>
        </div>

        <div class="pl-4 flex-none relative">
          <p>
            <a class="no-underline font-bold" :href="tweet_url" target="_blank" @click.stop>
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
      // `moment` has a warning about the date format in `created_at`
      // return moment(created_at).local().format('D MMM YYYY');
      return moment(new Date(created_at)).local().format('D MMM YYYY');
    },
    formattedText(text) {
      // Link hashtags, according to Twitter's guidelines
      this.tweet.entities.hashtags.map(elem => {
        text = text.replace(
          `#${elem}`,
          `<a class="no-underline" target="_blank" href="${this.baseLink}/search?q=%23${elem}">#${elem}</a>`
        );
      });

      // Link @mentions, according to Twitter's guidelines
      this.tweet.entities.user_mentions.map(elem => {
        text = text.replace(
          `@${elem.screen_name}`,
          `<a class="no-underline" target="_blank" href="${this.baseLink}/${elem.screen_name}">@${elem.screen_name}</a>`
        );
      });

      // Link URLs, according to Twitter's guidelines
      this.tweet.entities.urls.map(elem => {
        text = text.replace(
          elem.url,
          `<a class="no-underline" target="_blank" href="${elem.expanded_url}">${elem.display_url}</a>`
        );
      });

      // Insert HTML line breaks where necessary
      return text.replace('\n', '<br>');
    }
  },
  computed: {
    profile_url() {
      return this.baseLink + this.tweet.user.screen_name;
    },
    /**
     * Tweet URL computed property
     *
     * This works because `profile_url` is treated as a property that's
     * recalculated when dependencies update.
     */
    tweet_url() {
      return `${this.profile_url}/status/${this.tweet.id_str}`;
    }
  },

  mounted() {
    window.tweet = this.tweet;
  }
}
</script>
<style lang="scss">
  .twitter-card {
    font-family: "Helvetica Neue", "Segoe UI", Helvetica, Arial, sans-serif;
  }
</style>
