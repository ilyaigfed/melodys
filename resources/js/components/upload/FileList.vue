<template>
    <draggable v-model="files" group="people" @start="drag=true" @end="drag=false" style="width: 100%">
        <FileListCard
                v-for="(file, i) in files"
                :key="i"
                :file="file"
                :i="i"
        ></FileListCard>
    </draggable>
</template>

<script>
    import draggable from 'vuedraggable';
    import FileListCard from "./FileListCard";
    export default {
        name: "FileList",
        components: {
            FileListCard,
            draggable
        },
        data() { return {
            drag: null
        }},
        computed: {
            files: {
                get() {
                    return this.$store.getters.FILES;
                },
                set(value) {
                    this.$store.commit('SET_FILES', value);
                }
            },
        }
    }
</script>

<style scoped>

</style>