<template>
    <div class="flex w-full">
        <img :src="tweet.user.avatar" class="w-12 h-12 rounded-full mr-3">
        <div class="flex-grow">
            <app-tweet-username
                :user="tweet.user"
            />
            <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>

            <div class="flex flex-wrap mb-4 mt-4" v-if="images.length">
                <div class="w-6/12 flex-grow" v-for="(image, index) in images" :key="index">
                    <img :src="image.url" alt="">
                </div>
            </div>

            <div class="my-4 w-full" v-if="video">
                <video :src="video.url" controls preload muted class="rounded-lg w-full"></video>
            </div>

            <app-tweet-action-group
                :tweet="tweet"
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTweetVariantTweet",
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        computed: {
            images() {
                return this.tweet.media.data.filter(m => m.type === 'image')
            },

            video() {
                return this.tweet.media.data.filter(m => m.type === 'video')[0]
            }
        }
    }
</script>

<style scoped>

</style>
