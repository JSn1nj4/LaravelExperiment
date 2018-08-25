<template>
  <div :class="`loading-animation ${this.show ? 'show' : 'hide'} z-${zIndex}`">
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
    show: true,
    zIndex: '10'
  }),

  methods: {
    fadeOut() {
      this.show = false;
      setTimeout(function() {
        this.zIndex = '0';
        console.log("zIndex: " + this.zIndex);
      }, 1000);
    },

    fadeIn() {
      this.zIndex = '10';
      this.show = true;
    }
  }
}
</script>
<style lang="scss">
.loading-animation {
  transition: opacity 1s;

  &.show {
    opacity: 1;
  }

  &.hide {
    opacity: 0;
  }
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
