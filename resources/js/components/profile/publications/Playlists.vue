<template>
    <v-layout>
        <v-flex xs12 class="text-xs-center" v-if="!playlists">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="playlists && playlists.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">album</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-layout row wrap class="pl-3" v-if="playlists && playlists.length > 0">
                <Playlist v-for="(playlist, i) in playlists"
                          :key="i"
                          :playlist="playlist"
                          :i="i"
                ></Playlist>
            </v-layout>
        </transition>
    </v-layout>
</template>

<script>
    import Playlist from "./playlists/Playlist";
    export default {
        name: "Playlists",
        components: {Playlist},
        computed: {
            playlists() {
                return this.$store.getters.PROFILE_PLAYLISTS;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PROFILE_PLAYLISTS', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_PLAYLISTS', null);
        }
    }
</script>

<style scoped>

</style>