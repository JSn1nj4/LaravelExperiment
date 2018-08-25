<template>
  <div class="loading-animation absolute pin-t pin-l w-full"
    :class="[{ hide: isHidden }, zIndex]">
    <div class="loader-wrapper mx-auto" :style="`max-width: ${this.size}`">
      <socket :size="size" background="#00c49a"></socket>
    </div>
  </div>
</template>
<script>
import { Socket } from 'vue-loading-spinner';
export default {
  name: "load-animation",

  props: {
    size: {
      type: String,
      default: '80px'
    }
  },

  components: {
    Socket
  },

  data: () => ({
    isHidden: false,
    zIndex: 'z-50',
  }),

  methods: {
    fadeOut() {
      this.isHidden = true;
      setTimeout(function() {
        this.zIndex = 'z-0';
        console.log("zIndex: " + this.zIndex);
      }, 1000);
    },

    fadeIn() {
      this.zIndex = 'z-50';
      this.isHidden = false;
    }
  }
}
</script>
<style lang="scss">
.loading-animation {
  opacity: 1;
  transition: opacity 1s;

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
