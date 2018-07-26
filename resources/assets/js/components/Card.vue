<template>
    <div class="bg-grey-darkest p-4 my-4 rounded-lg border border-white trans-border-color hover:border-sea-green overflow-hidden flex max-w-sm w-full">
        <div class="flex-none">
            <a :href="link" target="_blank">
                <img width="48" height="48" :src="icon" class="border-solid border-2 border-white rounded-full">
            </a>
        </div>
        <div class="pl-4 flex flex-col">
            <p><a :href="link" target="_blank">{{ title }}</a></p>
            <p>{{ blurb }}</p>
        </div>
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
    created() {
        console.log(`Icon value: ${this.icon}`);
        console.log(`Title value: ${this.title}`);
        console.log(`Blurb value: ${this.blurb}`);
        console.log(`Link value: ${this.link}`);
    }
}
</script>
