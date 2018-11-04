<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <component :is="component" :event="event" v-if="component"></component>

    </card>
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  name: "git-hub-activity-wrapper",
  props: {
    event: Object
  },

  components: {
    Card
  },

  data: () => ({
    component: null
  }),

  computed: {
    loader() {
      if(!this.event.type) {
        return null;
      }
      return () => import(`./GitHubActivityTypes/${this.event.type}.vue`);
    }
  },

  mounted() {
    this.loader()
      .then(() => {
        this.component = () => this.loader();
      })
      .catch((error) => {
        console.log(`Unable to import component. Error: ${error}`);
      });
  }
}
</script>
