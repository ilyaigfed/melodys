<template>
    <v-layout column justify-start>
<!--        <v-flex xs8 class="pr-2">-->
<!--            <PublicationsNavigation></PublicationsNavigation>-->
<!--            <Publications></Publications>-->
<!--        </v-flex>-->
        <v-flex class="text-xs-center pt-5" v-if="!profile">
            <v-progress-circular
                    :size="50"
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <transition name="fade">
            <Main v-if="profile"></Main>
        </transition>
        <transition name="fade">
            <PanelUnderProfile v-if="profile"></PanelUnderProfile>
        </transition>
        <transition name="fade">
            <v-layout row v-if="profile">
                    <v-flex xs9>
                        <Publications></Publications>
                    </v-flex>
                    <v-flex xs3>
                        <ProfileInfo></ProfileInfo>
                    </v-flex>
            </v-layout>
        </transition>
    </v-layout>
</template>

<script>
    import Main from "./profile/Main";
    import Publications from "./profile/Publications";
    import PublicationsNavigation from "./profile/PublicationsNavigation";
    import PanelUnderProfile from "./profile/PanelUnderProfile";
    import ProfileInfo from "./profile/ProfileInfo";
    export default {
        name: "Profile",
        components: {
            ProfileInfo,
            PanelUnderProfile, 
            PublicationsNavigation, 
            Publications, 
            Main
        },
        computed: {
            profile() {
                return this.$store.getters.PROFILE;
            }
        },
        watch: {
            '$route.params.link'() {
                this.$store.commit('SET_PROFILE', null);
                this.$store.dispatch('GET_PROFILE', this.$route.params.link);
            }
        },
        created() {
            this.init();
        },
        destroyed() {
            this.$store.commit('SET_PROFILE', null);
        },
        methods: {
            init() {
                this.$store.dispatch('GET_PROFILE', this.$route.params.link);
            }
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