<template>
    <v-list-tile
            :to="'/tracks/'+track.link"
            avatar
    >
        <v-list-tile-action>
            <v-btn icon @click="play">
                <v-icon color="orange">play_arrow</v-icon>
            </v-btn>
        </v-list-tile-action>

        <v-list-tile-content>
            <v-list-tile-title class="body-2 font-weight-regular" v-text="track.title"></v-list-tile-title>
            <v-list-tile-title class="caption grey--text">{{ track.duration | minutes }}</v-list-tile-title>
        </v-list-tile-content>

        <v-list-tile-avatar>
            <img :src="track.image ? '/storage/'+track.image: '/siteimages/blurred-track-ava.jpg'">
        </v-list-tile-avatar>
    </v-list-tile>
</template>

<script>
    export default {
        name: "Track",
        props: ['track'],
        data() { return {
            this_track: false
        }},
        mounted() {

        },
        computed: {
            profile_tracks() {
                return this.$store.getters.PROFILE_TRACKS;
            }
        },
        watch: {

        },
        methods: {
            play(e) {
                e.preventDefault();
            }
        }
    }
</script>

<style scoped>
    .hidden-btn-block {
        opacity: 0;
        transition: opacity 0.3s;
    }

    .hidden-btn-block:hover {
        opacity: 1;
        background: rgba(255,255,255,0.5);
    }
</style>