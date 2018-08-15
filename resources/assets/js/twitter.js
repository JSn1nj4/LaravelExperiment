import TwitterTimeline from './TwitterTimeline.vue';
import Tweet from './Tweet.vue';

const NewestTweet = new Vue({
  el: '#newest-tweet',
  render: h => h(TwitterTimeline, {
    props: {
      count: 1
    }
  })
});

// const TweetWidget = new Vue({
//   el: '#tweet',
//   render: h => h(Tweet, {
//     props: {
//       tweetId: '834734319503552513'
//     }
//   })
// });
//
const TwitterTimelineWidget = new Vue({
  el: '#twitter',
  render: h => h(TwitterTimeline)
});
