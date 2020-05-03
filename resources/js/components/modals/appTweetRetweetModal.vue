<template>
    <div>
        {{ tweet }}
    </div>
</template>

<script>
    export default {
        name: "appTweetRetweetModal",
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
