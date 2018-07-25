<template>
    <div id="twitter-app">
        <card :icon="icon" :title="title" :blurb="blurb" :link="link"></card>
    </div>
</template>
<script>
import Card from './components/Card.vue';

export default {
    name: "twitter-app",
    components: {
        Card
    },
    data: () => ({
        icon: 'Twitter Icon',
        title: 'Tweet Title',
        blurb: 'For PHP, I have primarily not used a framework (outside of WordPress), though I have been learning Laravel recently.',
        link: 'http://example.com'
    })
}
</script>
