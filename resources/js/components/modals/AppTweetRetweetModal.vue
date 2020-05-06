<template>
    <div>
        <app-tweet-retweet-compose
            :tweet="tweet"
        />

        <component
            v-if="tweet"
            :is="`app-tweet-variant-${tweet.type}`"
            :tweet="tweet"
            class="border border-gray-700 rounded-lg mt-4 p-4"
        />
    </div>
</template>

<script>
    import AppTweetCompose from "../compose/AppTweetCompose";
    export default {
        name: "appTweetRetweetModal",
        components: { AppTweetCompose },
        props: {
            tweet: {
                required: true,
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>
