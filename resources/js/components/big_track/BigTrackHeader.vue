<template>
    <v-flex style="max-height: 253px;">
        <v-layout class="pa-4" id="bt-bg">
            <v-flex xs2>
                <v-img
                        :src="track.image ? '/storage/'+track.image: '/storage/common/none-avatar.jpg'"
                        aspect-ratio="1"
                        class="grey lighten-2"
                >
                </v-img>
            </v-flex>
            <v-flex xs8 class="pt-3 pl-4">
                <v-layout column>
                    <v-flex xs12 class="pb-2">
                        <span class="black grey--text body-1 pr-2 pl-2 pt-1 pb-1" style="cursor: pointer;" @click="$router.push(`/profile/${track.user.link}`)">{{ track.user.name}}</span>
                    </v-flex>
                    <v-flex xs12>
                        <span class="black white--text headline pr-2 pl-2 pt-1 pb-1">{{ track.title }}</span>
                    </v-flex>
                    <v-flex xs12 class="pt-2">
                        <v-btn color="orange" fab>
                            <v-icon color="white" large>play_arrow</v-icon>
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <img :src="track.image ? '/storage/'+track.image: '/storage/common/none-avatar.jpg'" id="sad" v-show="false">
    </v-flex>
</template>

<script>
    import FastAverageColor from 'fast-average-color';

    export default {
        name: "BigTrackHeader",
        data() { return {

        }},
        computed: {
            track() {
                return this.$store.getters.TRACK;
            }
        },
        mounted() {
            const img = document.getElementById('sad');

            img.onload = function() {
                const fac = new FastAverageColor(),
                    bt_bg = document.getElementById('bt-bg'),
                    color = fac.getColor(img);

                bt_bg.style.background = color.rgba;
            };
        }
    }
</script>

<style scoped>

</style>