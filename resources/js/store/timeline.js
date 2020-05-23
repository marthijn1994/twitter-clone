import getters from "./tweet/getters";
import mutations from "./tweet/mutations";
import actions from "./tweet/actions";
import axios from "axios";

export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters,
    mutations,
    actions: {
        ...actions,

        async quoteTweet(_, { tweet, data }) {
            await axios.post(`/api/tweets/${ tweet.id }/quotes`, data)
        },

        async replyToTweet(_, { tweet, data }) {
            await axios.post(`/api/tweets/${ tweet.id }/replies`, data)
        }
    }
}
