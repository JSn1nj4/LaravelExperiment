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
    },
    margin: String,
    padding: String,
  },

  data: () => ({
    urlIsSet: false,
    cursorClass: '',
    typeClasses: {
      'default': 'rounded-lg border border-gray-600 trans-border-color hover:border-sea-green-500 bg-gray-900',
      'transparent': ''
    }
  }),

  computed: {
    classes() {
      return `relative ${this.margin || 'my-4'} max-w-${this.size} w-full${this.cursorClass} z-30 ${this.padding || 'p-4'} ${this.typeClasses[this.type]}`;
    },
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

    // Update margin and padding settings for transparent cards, if none passed directly
    if(this.type === 'transparent' && !this.margin) {
      this.margin = '';
    }
    if(this.type === 'transparent' && !this.padding) {
      this.padding = 'px-4';
    }
  }
}
</script>
