<template>

</template>

<script>
    export default {
        name: "Home",
        computed: {
            message() {
                return this.$store.getters.WELCOME;
            }
        }
    }
</script>

<style scoped>

</style>