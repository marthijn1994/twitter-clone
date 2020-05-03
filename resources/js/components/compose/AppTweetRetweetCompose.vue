<template>
    <form class="flex" @submit.prevent="submit">
        <img :src="$user.avatar" class="w-12 h-12 mr-3 rounded-full" :alt="$user.name">
        <div class="flex-grow">

            <app-tweet-compose-textarea
                v-model="form.body"
                placeholder="Add a comment"
            />

            <div class="flex justify-between items-center">
                <div></div>
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
                        Tweet
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import compose from '../../mixins/compose'
    import axios from "axios";

    export default {
        name: "AppTweetRetweetCompose",
        mixins: [
            compose
        ],
        methods: {
            async post() {

            }
        }
    }
</script>

<style scoped>

</style>
