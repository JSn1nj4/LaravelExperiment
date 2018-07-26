<template>
    <div id="twitter-app" class="max-w-sm m-auto pb-4">
        <card v-for="(tweet, index) in tweets"
            :icon="tweet.icon"
            :title="`${tweet.name} ${tweet.username}`"
            :blurb="tweet.blurb"
            :link="tweet.link"
            :key="`tweet-${index}`"></card>
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
        tweets: [
            {
                icon: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
                name: 'Elliot Derhay',
                username: '@JSn1nj4',
                blurb: 'Had a @Wendys double cheeseburger today. Best burger I\'ve had in ages.',
                link: 'https://twitter.com/JSn1nj4/status/990660014984650753'
            },
            {
                icon: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
                name: 'Elliot Derhay',
                username: '@JSn1nj4',
                blurb: 'Twitter has some nice keyboard shortcuts. \`Shift+?\`',
                link: 'https://twitter.com/JSn1nj4/status/989678620598853635'
            },
            {
                icon: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
                name: 'Elliot Derhay',
                username: '@JSn1nj4',
                blurb: 'By the way, will you have a Disney-themed series in the near future, considering your recent daddy/daughter entertainment? 😉',
                link: 'https://twitter.com/JSn1nj4/status/972624583365939200'
            },
            {
                icon: 'https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_bigger.jpg',
                name: 'Elliot Derhay',
                username: '@JSn1nj4',
                blurb: 'For to us a child is born, to us a son is given, and the government will be on his shoulders. And he will be called Wonderful Counselor, Mighty God, Everlasting Father, Prince of Peace.\nIsaiah 9:6',
                link: 'https://twitter.com/JSn1nj4/status/945260403893985281'
            }
        ]
    })
}
</script>
