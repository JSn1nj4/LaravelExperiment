export default {
  name: "git-hub-activity-commits-mixin",
  computed: {
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
