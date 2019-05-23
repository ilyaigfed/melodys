<template>
    <v-layout column>
        <v-flex xs12>
            <v-layout>
                <BigTrackPanel></BigTrackPanel>
            </v-layout>
        </v-flex>
        <v-flex xs12 v-if="track.description">
            <v-layout>
                <BigTrackDescription></BigTrackDescription>
            </v-layout>
        </v-flex>
        <v-flex xs12>
            <v-layout wrap row>
                <v-flex xs12>
                    <BigTrackComments></BigTrackComments>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    import BigTrackPanel from "./BigTrackPanel";
    import BigTrackComments from "./BigTrackComments";
    import BigTrackDescription from "./BigTrackDescription";
    export default {
        name: "BigTrackLeftSide",
        components: {BigTrackDescription, BigTrackComments, BigTrackPanel},
        computed: {
            track() {
                return this.$store.getters.TRACK;
            }
        }
    }
</script>

<style scoped>

</style>