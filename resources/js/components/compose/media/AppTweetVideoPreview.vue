<template>
    <div class="flex flex-wrap mb-4">
        <div
            class="mb-4 relative"
        >
            <video
                class="rounded-lg"
                :src="generateVideoPreview(video)"
                controls
                preload
            >
            </video>

            <a
                href="#"
                class="bg-gray-900 w-8 h-8 rounded-full absolute top-0 right-0 mt-3 mr-3 flex items-center justify-center"
                @click.prevent="$emit('removed', video)"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                    class="fill-current text-gray-300"
                >
                    <path
                        d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                </svg>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTweetVideoPreview",
        props: {
            video: {
                required: true,
                type: File
            }
        },
        methods: {
            generateVideoPreview(video) {
                return URL.createObjectURL(video)
            }
        }
    }
</script>

<style scoped>

</style>
