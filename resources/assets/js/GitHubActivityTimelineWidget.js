/**
 * Activity item design inspiration:
 * - https://github.com/caseyscarborough/github-activity
 */

import GitHubActivityFeed from './GitHubActivityFeed.vue';

const GitHubActivityFeedWidget = new Vue({
  el: '#github_activity_feed',
  render: h => h(GitHubActivityFeed)
});
