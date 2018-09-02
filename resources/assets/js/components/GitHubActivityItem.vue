<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <div class="flex flex-row relative">
        <div class="text-grey far fa-arrow-alt-circle-up"></div>

        <div class="pl-4 flex-grow relative">
          <p class="text-grey">
            about X hours ago
          </p>

          <p class="font-white mt-1">
            <strong>
              <a href="#" target="_blank" class="no-underline">JSn1nj4</a> pushed to <a href="#" target="_blank" class="no-underline">master</a> at <a href="#" target="_blank" class="no-underline">JSn1nj4/ElliotDerhay.com</a>
            </strong>
          </p>

          <!-- Repeat for each commit pushed -->
          <p class="font-grey align-middle mt-1">
            <a href="#" target="_blank" class="no-underline font-bold">
              <img width="18" height="18" class="align-bottom" src="https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg">
            </a> <a href="#" target="_blank" class="no-underline">ffffff</a> Lorem ipsum dolor sit amet
          </p>
          <p class="font-grey align-middle mt-1">
            <a href="#" target="_blank" class="no-underline font-bold">
              <img width="18" height="18" class="align-bottom" src="https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg">
            </a> <a href="#" target="_blank" class="no-underline">ffffff</a> Lorem ipsum dolor sit amet
          </p>
        </div>
      </div>

    </card>
  </div>
</template>

<script>
import moment from 'moment';
import Card from './Card.vue';

export default {
  name: "git-hub-activity-item",
  components: {
    Card
  },
  props: {
    event: Object
  },
  data: () => ({
    baseLink: 'https://github.com'
  }),
  mounted() {
    console.log(this['github-activity']);
  }
}
</script>
