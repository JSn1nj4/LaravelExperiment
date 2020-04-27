<template>
  <div class="md:w-1/2 lg:w-1/3 project">
    <div class="px-4">
      <card :size="'md'" :padding="'p-0'">

        <a :href="project.demo_link || project.link" :target="project.demo_link ? '_self' : '_blank'">
          <img :src="project.thumbnail" class="block rounded-lg rounded-b-none">
        </a>

        <div class="p-4">
          <h4><a :href="project.link">{{ project.name }}</a></h4>
          <p>{{ project.short_desc }}</p>
        </div>

        <div class="flex flex-row pb-4">
          <div class="relative flex-grow">
            <p>
              <a :href="project.link" class="no-underline uppercase p-4 rounded-bl-lg" target="_blank" title="Open project repository">Project <i class="fas fa-link"></i></a>
            </p>
          </div>

          <div v-if="project.demo_link" class="text-right relative">
            <p>
              <a :href="project.demo_link" class="no-underline uppercase p-4 rounded-br-lg" title="Open project demo">Demo <i class="fas fa-laptop"></i></a>
            </p>
          </div>
        </div>

      </card>
    </div>
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  name: "project-card",
  components: {
    Card
  },
  props: {
    project: Object
  }
}

</script>
