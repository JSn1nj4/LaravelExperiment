<template>
    <div :class="classes">
        <slot></slot>
    </div>
</template>
<script>
export default {
    name: "card",
    props: {
        size: String
    },
    computed: {
        classes() {
            return `bg-grey-darkest p-4 my-4 rounded-lg border border-white trans-border-color hover:border-sea-green overflow-hidden flex max-w-${this.size} w-full`;
        }
    },
    mounted() {
        console.log(`Size: ${this.size}`);
    }
}
</script>
