import TwitterTimeline from './TwitterTimeline.vue';

const NewestTweet = new Vue({
  el: '#newest-tweet',
  render: h => h(TwitterTimeline, {
    props: {
      count: 1
    }
  })
});
