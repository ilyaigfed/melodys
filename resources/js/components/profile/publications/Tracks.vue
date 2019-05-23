<template>
    <v-layout>
        <v-flex xs12 class="text-xs-center" v-if="!tracks">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="tracks && tracks.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">album</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-list style="width: 100%" v-if="tracks && tracks.length > 0">
                <Track
                        v-for="(track, i) in tracks"
                        :key="i"
                        :track="track"
                >
                </Track>
            </v-list>
        </transition>
    </v-layout>
</template>

<script>
    import Track from "./tracks/Track";
    export default {
        name: "Tracks",
        components: {Track},
        data() { return {

        }},
        mounted() {
            this.init();
        },
        computed: {
            tracks() {
                return this.$store.getters.PROFILE_TRACKS;
            }
        },
        methods: {
            init() {
                this.$store.dispatch('GET_PROFILE_TRACKS', this.$route.params.link);
            }
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_TRACKS', null);
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