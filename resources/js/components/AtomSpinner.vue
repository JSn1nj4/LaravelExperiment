<template>
  <div class="atom-spinner" :style="`width: ${this.size}; height: ${this.size};`">
    <div class="spinner-inner">
      <div class="spinner-line" :style="`border-left-width: calc(${this.size} / 25); border-top-width: calc(${this.size} / 25); border-left-color: ${this.color};`"></div>
      <div class="spinner-line" :style="`border-left-width: calc(${this.size} / 25); border-top-width: calc(${this.size} / 25); border-left-color: ${this.color};`"></div>
      <div class="spinner-line" :style="`border-left-width: calc(${this.size} / 25); border-top-width: calc(${this.size} / 25); border-left-color: ${this.color};`"></div>
      <!--Chrome renders little circles malformed :(-->
      <div class="spinner-circle" :style="`color: ${this.color}; font-size: calc(${this.size} * 0.24);`">
        &#9679;
      </div>
    </div>
  </div>
</template>

<script>
/**
 * Adapted from HTML version of Atom Spinner from "Epic Spinners"
 * spinner collection website: https://epic-spinners.epicmax.co/
 */
export default {
  name: "atom-spinner",
  props: {
    size: {
      type: String,
      default: '60px',
    },
    color: {
      type: String,
      default: '#00C49A',
    },
  },
}
</script>

<style scoped>
  .atom-spinner,
  .atom-spinner * {
    box-sizing: border-box;
  }

  .atom-spinner {
    overflow: hidden;
  }

  .atom-spinner .spinner-inner {
    position: relative;
    display: block;
    height: 100%;
    width: 100%;
  }

  .atom-spinner .spinner-circle {
    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .atom-spinner .spinner-line {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    animation-duration: 1s;
    border-left-style: solid;
    border-top-style: solid;
    border-top-color: transparent;
  }

  .atom-spinner .spinner-line:nth-child(1) {
    animation: atom-spinner-animation-1 1s linear infinite;
    transform: rotateZ(120deg) rotateX(66deg) rotateZ(0deg);
  }
  .atom-spinner .spinner-line:nth-child(2) {
    animation: atom-spinner-animation-2 1s linear infinite;
    transform: rotateZ(240deg) rotateX(66deg) rotateZ(0deg);
  }
  .atom-spinner .spinner-line:nth-child(3) {
    animation: atom-spinner-animation-3 1s linear infinite;
    transform: rotateZ(360deg) rotateX(66deg) rotateZ(0deg);
  }

  @keyframes atom-spinner-animation-1 {
    100% {
      transform: rotateZ(120deg) rotateX(66deg) rotateZ(360deg);
    }
  }

  @keyframes atom-spinner-animation-2 {
    100% {
      transform: rotateZ(240deg) rotateX(66deg) rotateZ(360deg);
    }
  }

  @keyframes atom-spinner-animation-3 {
    100% {
      transform: rotateZ(360deg) rotateX(66deg) rotateZ(360deg);
    }
  }
</style>
