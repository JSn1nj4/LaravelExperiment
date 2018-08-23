<template>
  <div :class="`load-animation ${show ? 'show' : 'hide'}-animation`">
    <hexagon size="80px"></hexagon>
  </div>
</template>
<script>
import { Hexagon } from 'vue-loading-spinner';
export default {
  name: "load-animation",

  components: {
    Hexagon
  },

  data: () => ({
    show: true
  })
}
</script>
<style lang="scss">
.spinner--hexagon .spinner-inner {
  box-sizing: content-box;
}
.hexagon {
  background-color: #00c49a !important;
}
.hexagon:before {
  border-bottom-color: #00c49a !important;
}
.hexagon:after {
  border-top-color: #00c49a !important;
}
</style>
<style lang="scss" scoped>
</style>
