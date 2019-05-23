<template>
    <v-flex xs12>
        <v-subheader>Комментарии</v-subheader>
        <v-divider></v-divider>
        <v-flex xs12 class="text-xs-center pt-3" v-if="!comments">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="comments && comments.comments.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">textsms</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <v-list two-line v-if="comments">
            <BigTrackComment
                    v-for="(comment, i) in comments.comments"
                    :key="i"
                    :comment="comment"
            ></BigTrackComment>
        </v-list>
    </v-flex>
</template>

<script>
    import BigTrackComment from "./BigTrackComment";
    export default {
        name: "BigTrackComments",
        components: {BigTrackComment},
        data() { return {

        }},
        computed: {
            comments() {
                return this.$store.getters.TRACK_COMMENTS;
            }
        },
        mounted() {
            this.$store.dispatch('GET_TRACK_COMMENTS', this.$route.params.link);
        }
    }
</script>

<style scoped>

</style>