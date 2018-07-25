<template>
    <div id="">

    </div>
</template>
<script>
export default {
    name: "card",
    props: {
        icon: String,
        title: String,
        blurb: String,
        link: String
    },
    data: () => ({
        icon: '',
        title: '',
        blurb: '',
        link: ''
    }),
    created() {
        console.log(`Icon value: ${this.icon}`);
        console.log(`Title value: ${this.title}`);
        console.log(`Blurb value: ${this.blurb}`);
        console.log(`Link value: ${this.link}`);
    }
}
</script>
