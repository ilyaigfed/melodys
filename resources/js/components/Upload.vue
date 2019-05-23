<template>
    <v-layout row wrap align-center justify-center>
        <Choose></Choose>
        <transition name="fade">
            <File v-if="files && !make_playlist"></File>
            <Playlist v-if="files && make_playlist"></Playlist>
        </transition>
    </v-layout>
</template>

<script>
    import Choose from "./upload/Choose";
    import File from "./upload/File";
    import Playlist from "./upload/Playlist";
    export default {
        name: "Upload",
        components: {Playlist, File, Choose},
        data() { return {
            align_center: true,
            justify_center: true
        }},
        mounted() {
            this.init();
        },
        computed: {
            files() {
                return this.$store.getters.FILES;
            },
            make_playlist() {
                return this.$store.getters.MAKE_PLAYLIST;
            }
        },
        methods: {
            init() {
                this.$store.dispatch('GET_GENRES');
                this.$store.dispatch('GET_PLAYLIST_TYPES');
            }
        },
        destroyed() {
            this.$store.commit('SET_GENRES', null);
            this.$store.commit('SET_PLAYLIST_TYPES', null);
            this.$store.commit('SET_AVAILABLE_DURATION', null);
            this.$store.commit('SET_FILES', null);
        }
    }
</script>

<style scoped>
    .fade-enter-active {
        transition: opacity 0.5s ease-in-out;
    }

    .fade-enter-to {
        opacity: 1;
    }

    .fade-enter {
        opacity: 0;
    }
</style>