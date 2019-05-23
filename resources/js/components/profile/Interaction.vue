<template>
    <v-layout column>
        <transition name="fade">
            <v-flex xs12 v-if="profile" class="pt-4" style="max-height: 200px;">
                <v-flex xs12>
                    <v-layout row class="pl-3">
                        <v-avatar
                                size="100"
                                color="grey lighten-4"
                                @click="$router.push({ name: 'publications-all' })"
                                style="cursor: pointer;"
                                tile
                        >
                            <img :src="profile.image ? `/storage/${profile.image}`: '/storage/common/none-avatar.jpg'" alt="avatar">
                        </v-avatar>
                        <span @click="$router.push({ name: 'publications-all' })" class="display-1 ml-3" style="cursor: pointer;">{{ profile.name }}</span>
                    </v-layout>
                </v-flex>
                <v-flex xs12 class="pt-4">
                    <v-tabs slider-color="orange" active-class="">
                        <v-tab
                                v-for="(link, i) in links"
                                :key="i"
                                :to="link.to"
                        >
                            {{ link.name }}
                        </v-tab>
                    </v-tabs>
                </v-flex>
            </v-flex>
        </transition>
        <v-flex xs12 class="text-xs-center pt-5" v-if="!profile">
            <v-progress-circular
                    :size="50"
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="profile">
            <router-view></router-view>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "Interaction",
        data() { return {
            links: [
                { name: 'Подписчики', to: { name: 'interaction-followers' } },
                { name: 'Подписки', to: { name: 'interaction-followings' } }
            ]
        }},
        mounted() {
            this.$store.dispatch('GET_INTERACTION_PROFILE', this.$route.params.link);
        },
        computed: {
            profile() {
                return this.$store.getters.INTERACTION_PROFILE;
            }
        },
        destroyed() {
            this.$store.commit('SET_INTERACTION_PROFILE', null);
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