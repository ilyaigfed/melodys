<template>
<!--    <v-container>-->
<!--        <v-layout justify-center>-->
            <v-flex xs10 lg8>
                <FileCard
                        v-for="(file, i) in files"
                        :key="i"
                        :file="file"
                        :i="i"
                >
                </FileCard>
            </v-flex>
<!--        </v-layout>-->
<!--    </v-container>-->
</template>

<script>
    import FileCard from "./FileCard";
    export default {
        name: "File",
        components: {FileCard},
        data() { return {

        }},
        computed: {
            files() {
                return this.$store.getters.FILES;
            },
            user() {
                return this.$store.getters.USER;
            }
        }
    }
</script>

<style scoped>

</style>