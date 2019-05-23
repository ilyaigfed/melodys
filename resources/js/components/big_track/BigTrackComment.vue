<template>
    <v-flex xs12>
        <v-list-tile
                avatar
        >
            <v-list-tile-avatar @click="$router.push('/profile/'+comment.user.link)" style="cursor: pointer;">
                <img :src="comment.user.image ? '/storage/'+comment.user.image: '/storage/common/none-avatar.jpg'">
            </v-list-tile-avatar>

            <v-list-tile-content>
                <v-list-tile-title>{{ comment.user.name }}</v-list-tile-title>
                <v-list-tile-sub-title>{{ comment.created_at }}</v-list-tile-sub-title>
            </v-list-tile-content>
        </v-list-tile>
        <div class="pl-3 pb-3">{{ comment.text }}</div>
    </v-flex>
</template>

<script>
    export default {
        name: "BigTrackComment",
        props: ['comment']
    }
</script>

<style scoped>

</style>