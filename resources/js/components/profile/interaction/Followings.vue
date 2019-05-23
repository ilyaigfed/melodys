<template>
    <v-flex xs12>
        <v-flex xs12 class="text-xs-center" v-if="!followings">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="followings && followings.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">face</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-layout row wrap v-if="followings && followings.length > 0">
                <Following v-for="(following, i) in followings"
                           :key="i"
                           :following="following"
                ></Following>
            </v-layout>
        </transition>
    </v-flex>
</template>

<script>
    import Following from "./followings/Following";
    export default {
        name: "Followings",
        components: {Following},
        computed: {
            followings() {
                return this.$store.getters.PROFILE_FOLLOWINGS;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PROFILE_FOLLOWINGS', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_FOLLOWINGS', null);
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