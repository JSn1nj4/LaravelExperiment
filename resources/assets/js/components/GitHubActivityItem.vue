<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'">

      <!--  -->

    </card>
  </div>
</template>

<script>
import moment from 'moment';
import Card from './Card.vue';

export default {
  name: "github-activity-item",
  components: {
    Card
  },
  props: {
    'github-activity': Object
  },
  data: () => ({
    baseLink: 'https://github.com'
  }),
  mounted() {
    console.log(this['github-activity']);
  }
}
</script>
