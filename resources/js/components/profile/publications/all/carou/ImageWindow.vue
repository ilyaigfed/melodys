<template>
    <v-dialog v-model="dialog" persistent max-width="600">
        <template v-slot:activator="{ on }">
            <v-flex xs3 class="pa-1" v-on="on" style="cursor: pointer">
                <v-img :src="'/storage/'+item.image" aspect-ratio="1.7">
                </v-img>
            </v-flex>
        </template>
        <v-card>
            <v-layout row justify-space-between align-center>
                <v-subheader>{{ item.created_at }}</v-subheader>
                <v-btn icon small @click="dialog = false">
                    <v-icon color="grey">close</v-icon>
                </v-btn>
            </v-layout>
            <v-card-text v-if="item">
                <v-img
                        :src="'/storage/'+item.image"
                        aspect-ratio="1.7"
                >
                </v-img>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "ImageWindow",
        props: ['item'],
        data() { return {
            dialog: false
        }}
    }
</script>

<style scoped>

</style>