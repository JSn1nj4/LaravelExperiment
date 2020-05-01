<template>
  <div :class="`${displayClass} w-full bg-gray-900`">
    <div id="dnt-box" class="fixed bottom-0 left-0 z-30 bg-gray-900 w-full p-8" ref="dntBox">
      <div class="flex container mx-auto">
        <div class="flex flex-grow h-full">
          <p class="p-4 m-2">Please confirm whether you would like to allow tracking cookies on my site, in accordance with my <a href="/privacy-policy/">privacy policy</a>.</p>
        </div>
        <div class="flex w-64">
          <button :class="`${btnClasses} bg-sea-green-600 text-gray-900`" @click="allowTracker(true)">Allow</button>
          <button :class="`${btnClasses} bg-gray-800 text-sea-green-500`" @click="allowTracker(false)">Deny</button>
        </div>
      </div>
    </div>
    <div id="dnt-spacer" class="block w-full" :style="`height: ${boxHeight};`"></div>
  </div>
</template>

<script>
export default {
  data: () => ({
    'btnClasses': 'flex-1 p-4 m-2 font-bold',
    'boxHeight': 'auto',
    'displayClass': 'block',
  }),
  methods: {
    allowTracker(allow) {
      this.$emit('allow_tracker', allow);
      this.hide();
    },
    setBoxHeight() {
      this.boxHeight = `${this.$refs.dntBox.clientHeight}px`;
    },
    hide() {
      this.displayClass = 'hidden';
    }
  },
  beforeMount() {
    if(document.cookie.indexOf('DNT=0') !== -1 && navigator.doNotTrack === '1') this.hide();
  },
  mounted() {
    if(this.displayClass !== 'hidden') this.setBoxHeight();
  },
}
</script>
