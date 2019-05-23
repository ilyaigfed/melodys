<template>
    <v-flex xs12>
        <v-list-tile
                :key="post.created_at"
                avatar
        >
            <v-list-tile-avatar @click="$router.push('/profile/'+post.author.link)" style="cursor: pointer;">
                <img :src="post.author.image ? '/storage/'+post.author.image: '/storage/common/none-avatar.jpg'">
            </v-list-tile-avatar>

            <v-list-tile-content>
                <v-list-tile-title>{{ post.author.name }}</v-list-tile-title>
                <v-list-tile-sub-title>{{ post.created_at }}</v-list-tile-sub-title>
            </v-list-tile-content>
        </v-list-tile>
        <div class="pl-3">{{ post.text }}</div>
    </v-flex>
</template>

<script>
    export default {
        name: "Post",
        props: ['post']
    }
</script>

<style scoped>

</style>