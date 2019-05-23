<template>
    <v-flex xs12>
        <v-subheader>Последние загруженные треки</v-subheader>
        <v-flex xs12 class="text-xs-center" v-if="!last_uploaded_tracks">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="last_uploaded_tracks && last_uploaded_tracks.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">album</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-layout column v-if="last_uploaded_tracks && last_uploaded_tracks.length > 0">
                <Track v-for="(track, i) in last_uploaded_tracks" :track="track" :key="i"></Track>
            </v-layout>
        </transition>
    </v-flex>
</template>

<script>
    import Track from "../tracks/Track";
    export default {
        name: "LastUploadedTracks",
        components: {Track},
        computed: {
            last_uploaded_tracks() {
                return this.$store.getters.PROFILE_LAST_UPLOADED_TRACKS;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PROFILE_LAST_UPLOADED_TRACKS', this.$route.params.link);
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>