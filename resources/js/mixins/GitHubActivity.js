import moment from 'moment';
import Card from '../components/Card.vue';

export default {
  name: "git-hub-activity-mixin",
  components: {
    Card
  },
  props: {
    event: Object
  },
  data: () => ({
    baseLink: 'https://github.com',
    tmpAvatarUrl: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg',
  }),
  computed: {
    formattedDate() {
      return moment(this.event.created_at).fromNow();
    },
    profileUrl() {
      return `${this.baseLink}/${this.event.actor.login}`;
    },
    repoUrl() {
      return `${this.baseLink}/${this.event.repo.name}`;
    },
    branchName() {
      return this.event.payload.ref.replace('refs/heads/', '');
    },
    branchUrl() {
      return `${this.repoUrl}/tree/${this.branchName}`;
    },
    branchCommitsUrl() {
      return `${this.repoUrl}/commits/${this.branchName}`;
    },
    displayCommits() {
      let commits = this.event.payload.commits;
      return commits.length > 4 ? commits.slice(0, 4) : commits;
    },
    extraCommitsCount() {
      let commits = this.event.payload.commits;
      return commits.length > 4 ? commits.length - 4 : 0;
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
  methods: {
    shortMsg(msg) {
      let msgEnd = msg.indexOf('\n');
      return msgEnd >= 0 ? msg.slice(0, msgEnd) : msg;
    },
    shortHash(hash) {
      return hash.slice(0, 6);
    },
    commitUrl(hash) {
      return `${this.repoUrl}/commit/${hash}`;
    }
  }
}
