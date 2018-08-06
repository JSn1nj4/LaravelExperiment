import TwitterTimeline from './TwitterTimeline.vue';
import Tweet from './Tweet.vue';

const TweetWidget = new Vue({
  el: '#tweet',
  render: h => h(Tweet, {
    props: {
      tweetId: '834734319503552513'
    }
  })
});

const TwitterTimelineWidget = new Vue({
  el: '#twitter',
  render: h => h(TwitterTimeline)
});
