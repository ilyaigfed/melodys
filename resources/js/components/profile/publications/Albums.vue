<template>
    <v-layout>
        <v-flex xs12 class="text-xs-center" v-if="!albums">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="albums && albums.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">album</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-layout row wrap class="pl-3" v-if="albums && albums.length > 0">
                <Album v-for="(album, i) in albums"
                       :key="i"
                       :album="album"
                       :i="i"
                ></Album>
            </v-layout>
        </transition>
    </v-layout>
</template>

<script>
    import Album from "./albums/Album";
    export default {
        name: "Albums",
        components: {Album},
        mounted() {
            this.init();
        },
        computed: {
            albums() {
                return this.$store.getters.PROFILE_ALBUMS;
            }
        },
        methods: {
            init() {
                this.$store.dispatch('GET_PROFILE_ALBUMS', this.$route.params.link);
            }
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_ALBUMS', null);
        }
    }
</script>

<style scoped>

</style>