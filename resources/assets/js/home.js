import TwitterTimeline from './TwitterTimeline.vue';
import GitHubActivityFeed from './GitHubActivityFeed.vue';

const HomeTwitterTimeline = new Vue({
  el: '#twitter_timeline-home',
  render: h => h(TwitterTimeline, {
    props: {
      count: 2
    }
  })
});

const HomeGitHubActivityFeed = new Vue({
  el: '#github_activity_feed-home',
  render: h => h(GitHubActivityFeed, {
    props: {
      count: 3
    }
  })
});
