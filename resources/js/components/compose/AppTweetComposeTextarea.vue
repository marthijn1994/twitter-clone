<template>
    <textarea
        class="bg-gray-900 w-full outline-none text-gray-300 text-lg resize-none mb-2"
        placeholder="What's happening?"
        autofocus
        @input="$emit('input', $event.target.value); resize($event)"
        :value="value"
    ></textarea>
</template>

<script>
    export default {
        name: "AppTweetComposeTextarea",
        props: {
            value: {
                required: false
            }
        },
        methods: {
            resize(e) {
                e.target.style.height = 'auto'
                e.target.style.height = `${e.target.scrollHeight}px`
            }
        }
    }
</script>

<style scoped>

</style>
