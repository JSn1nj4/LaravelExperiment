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
        url: String
    },
    data: () => ({
        urlIsSet: false,
        cursorClass: ''
    }),
    computed: {
        classes() {
            return `bg-grey-darkest p-4 my-4 rounded-lg border border-grey-dark trans-border-color hover:border-sea-green overflow-hidden flex max-w-${this.size} w-full${this.cursorClass}`;
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
