import formatDistanceToNow from 'date-fns/formatDistanceToNow';
import en_US_Locale from 'date-fns/locale/en-US';

export default {
  name: "git-hub-activity-base-mixin",
  props: {
    event: Object
  },
  data: () => ({
    baseLink: 'https://github.com',
    tmpAvatarUrl: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg',
  }),
  computed: {
    formattedDate() {
      return formatDistanceToNow(new Date(this.event.created_at), {addSuffix: true, locale: en_US_Locale});
    },
    profileUrl() {
      return `${this.baseLink}/${this.event.actor.login}`;
    },
    repoUrl() {
      return `${this.baseLink}/${this.event.repo.name}`;
    },
    issueNumberString() {
      return `Issue #${this.event.payload.issue.number}`;
    },
    issueComment() {
      let body = this.event.payload.comment.body;
      let limit = 280;
      return (body.length > limit) ? body.slice(0, 280).slice(0, body.lastIndexOf(' ')) + '...' : body;
    }
  },
}
