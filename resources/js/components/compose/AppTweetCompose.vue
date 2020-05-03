<template>
    <form class="flex" @submit.prevent="submit">
        <img :src="$user.avatar" class="w-12 h-12 mr-3 rounded-full">
        <div class="flex-grow">

            <app-tweet-compose-textarea
                v-model="form.body"
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
                            id="media-compose"
                            @selected="onMediaSelected"
                        />
                    </li>
                </ul>
                <div class="flex items-center justify-end">
                    <div>
                        <app-tweet-compose-limit
                            v-if="form.body.length > 1"
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
    import axios from 'axios'

    export default {
        name: "AppTweetCompose",
        data() {
            return {
                form: {
                    body: '',
                    media: []
                },

                media: {
                    images: [],
                    video: null,
                    progress: 0
                },

                mediaTypes: {}
            }
        },
        methods: {
            async submit() {
                if (this.media.images.length || this.media.video) {
                    let media = await this.uploadMedia()
                    this.form.media = media.data.data.map(r => r.id)
                }

                await axios.post('/api/tweets', this.form)

                this.resetForm()
            },

            async uploadMedia() {
                return await axios.post('/api/media', this.buildMediaForm(), {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                    onUploadProgress: this.handleUploadProgress
                })
            },

            handleUploadProgress(event) {
                this.media.progress = parseInt(Math.round((event.loaded / event.total) * 100))
            },

            buildMediaForm() {
                let form = new FormData()

                if (this.media.images.length) {
                    this.media.images.forEach((image, index) => {
                        form.append(`media[${index}]`, image)
                    })
                }

                if (this.media.video) {
                    form.append('media[0]', this.media.video)
                }

                return form
            },

            async getMediaTypes() {
                let response = await axios.get('/api/media/types')

                this.mediaTypes = response.data.data
            },

            onMediaSelected(files) {
                Array.from(files).slice(0, 4).forEach((file) => {
                    if (this.mediaTypes.image.includes(file.type)) {
                        this.media.images.push(file)
                    }

                    if (this.mediaTypes.video.includes(file.type)) {
                        this.media.video = file
                    }
                })

                if (this.media.video) {
                    this.media.images = []
                }
            },

            removeVideo(video) {
                this.media.video = null
            },

            removeImage(image) {
                this.media.images = this.media.images.filter((i) => {
                    return image !== i
                })
            },

            resetForm() {
                this.form.body = ''
                this.form.media = []
                this.media.images = []
                this.media.video = null
                this.media.progress = 0
            }
        },
        mounted() {
            this.getMediaTypes()
        }
    }
</script>

<style scoped>

</style>
