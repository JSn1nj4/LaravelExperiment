<template>
  <div :class="classes" @click="click">
    <slot></slot>
  </div>
</template>
<script>
export default {
  name: "card",

  props: {
    size: String,
    url: String,
    type: {
      type: String,
      default: 'default'
    }
  },

  data: () => ({
    urlIsSet: false,
    cursorClass: '',
    typeClasses: {
      'default': 'p-4 rounded-lg border border-grey-dark trans-border-color hover:border-sea-green bg-black',
      'transparent': 'px-4'
    }
  }),

  computed: {
    classes() {
      return `relative my-4 max-w-${this.size} w-full${this.cursorClass} z-30 ${this.typeClasses[this.type]}`;
    }
  },

  methods: {
    click() {
      if(this.urlIsSet) {
        open(this.url, '_blank');
      }
    }
  },

  mounted() {
    if(this.url && this.url.length > 0) {
      this.cursorClass = ' cursor-pointer';
      this.urlIsSet = true;
    }
  }
}
</script>
