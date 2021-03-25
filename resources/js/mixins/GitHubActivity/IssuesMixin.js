export default {
  name: "git-hub-activity-issues-mixin",
  computed: {
    issueNumberString() {
      return `Issue #${this.event.payload.issue.number}`;
    },
  },
}
