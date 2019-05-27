import ProjectsList from './ProjectsList.vue';

const MainProjectsList = new Vue({
  el: '#main-projects-list-wrapper',
  render: h => h(ProjectsList, {
    props: {
      count: 12
    }
  })
});
