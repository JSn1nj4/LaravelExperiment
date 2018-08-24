<template>
  <div :class="`loading-animation ${this.show ? 'show' : 'hide'}`">
    <socket size="80px" background="#00c49a"></socket>
  </div>
</template>
<script>
import { Socket } from 'vue-loading-spinner';
export default {
  name: "load-animation",

  components: {
    Socket
  },

  data: () => ({
    show: true
  }),

  methods: {
    fadeOut() {
      alert('Fading out');
      this.show = false;
    }
  }
}
</script>
<style lang="scss">
.loading-animation.hide {
  display: none;
}
.hex-brick {
  animation-name: socket-fade !important;
}
@keyframes socket-fade {
  0% {
    background: #fff;
  }
  50% {
    background: #00c49a;
  }
  100% {
    background: #fff;
  }
}
</style>
<style lang="scss" scoped>
</style>
