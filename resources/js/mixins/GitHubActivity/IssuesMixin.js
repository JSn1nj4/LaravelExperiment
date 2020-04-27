export default {
  name: "git-hub-activity-issues-mixin",
  computed: {
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
