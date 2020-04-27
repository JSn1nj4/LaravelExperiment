export default {
  name: "git-hub-activity-branches-mixin",
  computed: {
    branchName() {
      return this.event.payload.ref.replace('refs/heads/', '');
    },
    branchUrl() {
      return `${this.repoUrl}/tree/${this.branchName}`;
    },
  },
}
