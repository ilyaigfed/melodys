<template>
    <v-layout column justify-start>
        <v-flex class="text-xs-center pt-5" v-if="!track">
            <v-progress-circular
                    :size="50"
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <transition name="fade">
            <BigTrackHeader v-if="track"></BigTrackHeader>
        </transition>
        <transition name="fade">
            <v-layout row v-if="track">
                <v-flex xs9>
                    <BigTrackLeftSide></BigTrackLeftSide>
                </v-flex>
                <v-flex xs3>
                    <BigTrackRightSide></BigTrackRightSide>
                </v-flex>
            </v-layout>
        </transition>
    </v-layout>
</template>

<script>
    import BigTrackHeader from "./big_track/BigTrackHeader";
    import BigTrackLeftSide from "./big_track/BigTrackLeftSide";
    import BigTrackRightSide from "./big_track/BigTrackRightSide";
    export default {
        name: "BigTrack",
        components: {BigTrackRightSide, BigTrackLeftSide, BigTrackHeader},
        data() { return {
            snackbar: false
        }},
        computed: {
            track() {
                return this.$store.getters.TRACK;
            },
            user() {
                return this.$store.getters.USER;
            }
        },
        mounted() {
            this.$store.dispatch('GET_TRACK', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_TRACK', null);
            this.$store.commit('SET_TRACK_COMMENTS', null);
        },
        methods: {
            reply() {
                let tmp   = document.createElement('INPUT'),
                    focus = document.activeElement;

                tmp.value = window.location.href;

                document.body.appendChild(tmp);
                tmp.select();
                document.execCommand('copy');
                document.body.removeChild(tmp);
                focus.focus();
                this.snackbar = true;
            },
            like() {
                this.$store.dispatch('LIKE_TRACK', this.$route.params.link);
            },
            deleteLike() {
                this.$store.dispatch('DELETE_TRACK_LIKE', this.$route.params.link);
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