<template>
    <transition name="fade">
        <v-footer
                app
                height="auto"
        >
            <v-layout row wrap justify-center>
                <v-flex xs12 lg8>
                    <v-layout row wrap justify-center>

<!--                        <v-flex xs1 class="pl-2">-->
<!--                            <v-slider-->
<!--                                    v-model="volume"-->
<!--                                    @input="updateVolume(volume)"-->
<!--                                    max="1"-->
<!--                                    step="0.01"-->
<!--                                    :vertical="true"-->
<!--                            ></v-slider>-->
<!--                        </v-flex>-->
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-footer>
    </transition>
</template>

<script>
    import {Howl, Howler} from 'howler';
    export default {
        name: "Player",
        data() { return {
            volume: 0.8,
        }},
        computed: {

        },
        watch: {

        },
        mounted() {
            Howler.volume(this.volume);
        },
        methods: {
            updateVolume(volume) {
                Howler.volume(volume);
            },
        }

    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }
</style>