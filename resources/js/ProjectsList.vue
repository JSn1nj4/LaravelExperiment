<template>
  <div class="block md:flex flex-wrap projects-list pb-4" :style="`min-height: ${this.loaderSize}`">

    <project-card v-for="(project, index) in projects" :key="`project-${index}`" :project="project"></project-card>

  </div>
</template>
<script>
import LoadingAnimation from './components/LoadingAnimation.vue';
import ProjectCard from './components/ProjectCard.vue';

export default {
  name: 'projects-list',
  props: {
    count: {
      default: 12,
      type: Number
    },
    loaderSize: {
      default: '40px',
      type: String
    }
  },

  components: {
    LoadingAnimation,
    ProjectCard
  },

  data: () => ({
    projects: []
  }),

  mounted() {
    axios.get(`/api/projects/${this.count}`)
      .then(response => {
        this.projects = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>
