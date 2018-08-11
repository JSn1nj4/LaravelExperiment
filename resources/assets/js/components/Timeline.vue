<template>
  <div class="timeline relative mb-4">

    <div v-if="showLine" :class="`${commonClasses} pin-t border-solid h-full`">&nbsp;</div>
    <slot></slot>
    <div v-if="showLine" :class="`${commonClasses} pin-b border-dashed h-4 -mb-4`">&nbsp;</div>

  </div>
</template>
<script>
export default {
  name: "timeline",

  props: {
    showLine: {
      type: Boolean,
      default: true
    }
  },

  data: () => ({
    commonClasses: 'absolute w-10 border-r border-grey-dark'
  }),
}
</script>
