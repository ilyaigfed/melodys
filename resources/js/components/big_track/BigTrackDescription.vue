<template>
    <v-flex xs12>
        <v-subheader>Описание</v-subheader>
        <p class="pl-3">{{ track.description }}</p>
    </v-flex>
</template>

<script>
    export default {
        name: "BigTrackDescription",
        computed: {
            track() {
                return this.$store.getters.TRACK;
            }
        }
    }
</script>

<style scoped>

</style>