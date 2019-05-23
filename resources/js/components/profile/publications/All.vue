<template>
    <v-layout row wrap>
        <Carou v-if="profile.settings.show_profile_photos"></Carou>
        <LastUploadedTracks></LastUploadedTracks>
        <Posts v-if="profile.settings.show_profile_posts"></Posts>
    </v-layout>
</template>

<script>
    import Carou from "./all/Carou";
    import UploadAPhoto from "./all/UploadAPhoto";
    import LastUploadedTracks from "./all/LastUploadedTracks";
    import Posts from "./all/Posts";
    export default {
        name: "All",
        components: {Posts, LastUploadedTracks, UploadAPhoto, Carou},
        methods: {

        },
        computed: {
            profile() {
                return this.$store.getters.PROFILE;
            }
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_PHOTOS', null);
            this.$store.commit('SET_PROFILE_LAST_UPLOADED_TRACKS', null);
            this.$store.commit('SET_PROFILE_POSTS', null);
        }
    }
</script>

<style scoped>

</style>