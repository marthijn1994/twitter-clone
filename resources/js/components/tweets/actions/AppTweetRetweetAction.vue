<template>
    <div>
        <app-dropdown v-if="!retweeted">

            <template slot="trigger">
                <app-tweet-retweet-action-button
                    :tweet="tweet"
                    :retweeted="retweeted"
                />
            </template>

            <app-dropdown-item @click.prevent="retweetOrUnretweet">
                Retweet
            </app-dropdown-item>
            <app-dropdown-item
                @click.prevent="$modal.show(AppTweetRetweetModal, {
                    tweet
                })"
            >
                Retweet with comment
            </app-dropdown-item>

        </app-dropdown>
        <app-tweet-retweet-action-button
            v-else
            :tweet="tweet"
            :retweeted="retweeted"
            @click.prevent="retweetOrUnretweet"
        />
    </div>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
    import AppTweetRetweetModal from '../../modals/AppTweetRetweetModal'

    export default {
        name: "AppTweetRetweetAction",
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                AppTweetRetweetModal
            }
        },
        computed: {
            ...mapGetters({
                retweets: 'retweets/retweets'
            }),

            retweeted() {
                return this.retweets.includes(this.tweet.id)
            }
        },
        methods: {
            ...mapActions({
                retweetTweet: 'retweets/retweetTweet',
                unretweetTweet: 'retweets/unretweetTweet'
            }),

            retweetOrUnretweet() {
                if (this.retweeted) {
                    this.unretweetTweet(this.tweet)
                    return
                }
                this.retweetTweet(this.tweet)
            }
        }
    }
</script>

<style scoped>

</style>
