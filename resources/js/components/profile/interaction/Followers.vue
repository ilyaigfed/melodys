<template>
    <v-flex xs12>
        <v-flex xs12 class="text-xs-center" v-if="!followers">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="followers && followers.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">face</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-layout row wrap v-if="followers && followers.length > 0">
                <Follower v-for="(follower, i) in followers"
                          :key="i"
                          :follower="follower"
                ></Follower>
            </v-layout>
        </transition>
    </v-flex>
</template>

<script>
    import Follower from "./followers/Follower";
    export default {
        name: "Followers",
        components: {Follower},
        computed: {
            followers() {
                return this.$store.getters.PROFILE_FOLLOWERS;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PROFILE_FOLLOWERS', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_FOLLOWERS', null);
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