<template>
    <form class="flex" @submit.prevent="submit">
        <img :src="$user.avatar" class="w-12 h-12 mr-3 rounded-full" :alt="$user.name">
        <div class="flex-grow">

            <app-tweet-compose-textarea
                v-model="form.body"
                placeholder="Tweet your reply"
            />

            <app-tweet-media-progress-indicator
                v-if="media.progress"
                class="mb-4"
                :progress="media.progress"
            />

            <app-tweet-image-preview
                v-if="media.images.length"
                :images="media.images"
                @removed="removeImage"
            />

            <app-tweet-video-preview
                v-if="media.video"
                :video="media.video"
                @removed="removeVideo"
            />

            <div class="flex justify-between items-center">
                <ul class="flex items-center">
                    <li class="mr-4">
                        <app-tweet-compose-media-button
                            id="media-compose-reply"
                            @selected="onMediaSelected"
                        />
                    </li>
                </ul>
                <div class="flex items-center justify-end">
                    <div>
                        <app-tweet-compose-limit
                            class="mr-2"
                            :body="form.body"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                        Reply
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import {  mapActions } from "vuex";
    import compose from '../../mixins/compose'

    export default {
        name: "AppTweetReplyCompose",
        mixins: [
            compose
        ],
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        methods: {
            ...mapActions({
                replyToTweet: 'timeline/replyToTweet'
            }),

            async post() {
                await this.replyToTweet({
                    tweet: this.tweet,
                    data: this.form
                })
                this.$emit('success')
            }
        }
    }
</script>

<style scoped>

</style>
