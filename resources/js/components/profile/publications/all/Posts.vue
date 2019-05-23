<template>
    <v-flex xs12>
        <v-subheader>Записи</v-subheader>
        <CreatePost v-if="create_post"></CreatePost>
        <v-flex xs12 class="text-xs-center" v-if="!posts">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="posts && posts.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">textsms</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <v-list two-line v-if="posts && posts.length > 0">
            <Post v-for="(post, i) in posts"
                  :post="post"
                  :key="i"
            >
            </Post>
        </v-list>
    </v-flex>
</template>

<script>
    import CreatePost from "./posts/CreatePost";
    import Post from "./posts/Post";
    export default {
        name: "Posts",
        components: {Post, CreatePost},
        computed: {
            posts() {
                return this.$store.getters.PROFILE_POSTS;
            },
            user() {
                return this.$store.getters.USER;
            },
            profile() {
                return this.$store.getters.PROFILE;
            },
            create_post() {
                // if(this.profile.settings.posts_only_from_me) {
                //     if(this.user) {
                //         return this.user.link === this.profile.link;
                //     } else {
                //         return false;
                //     }
                // } else {
                //     if(this.user) {
                //         return true;
                //     } else {
                //         return false;
                //     }
                // }
                if(this.user) {
                    if(this.profile.settings.posts_only_from_me) {
                        return this.user.link === this.profile.link;
                    }

                    return true;
                }

                return false;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PROFILE_POSTS', this.$route.params.link);
        }
    }
</script>

<style scoped>

</style>