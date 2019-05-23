<template>
    <v-flex xs3 lg2 class="pa-4">
        <v-layout column align-center>
            <v-avatar
                    size="180"
                    color="grey lighten-4"
                    style="cursor: pointer;"
                    @click="$router.push(`/profile/${follower.link}`)"
                    tile
            >
                <img :src="follower.image ? `/storage/${follower.image}`: '/storage/common/none-avatar.jpg'" alt="avatar">
            </v-avatar>
            <span class="font-weight-thin mt-2" style="cursor: pointer;" @click="$router.push(`/profile/${follower.link}`)">{{ follower.name }}</span>
        </v-layout>
    </v-flex>
</template>

<script>
    export default {
        name: "Follower",
        props: ['follower']
    }
</script>

<style scoped>

</style>