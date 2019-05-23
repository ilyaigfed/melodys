<template>
    <v-flex xs12 class="pa-4">
        <v-layout column v-if="user">
            <v-flex xs8>
                <v-layout row wrap>
                    <v-flex xs1>
                        <v-avatar
                                color="grey lighten-4"
                        >
                            <img :src="user.image ? `/storage/${user.image}`: `/storage/common/none-avatar.jpg`" alt="avatar">
                        </v-avatar>
                    </v-flex>
                    <v-flex xs11>
                        <v-text-field
                                label="Ваш комментарий"
                                solo
                                v-model="comment"
                                @keyup.enter="sendComment"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-layout row wrap>
            <v-flex xs8>
                <template v-if="user">
                    <v-btn small class="grey--text" v-if="!track.liked" @click="like">
                        <v-icon color="grey" small left>favorite</v-icon>
                        Мне нравится
                    </v-btn>
                    <v-btn small color="orange" class="white--text" v-else @click="deleteLike">
                        <v-icon color="white" small left>favorite</v-icon>
                        Мне нравится
                    </v-btn>
                </template>
                <v-btn small class="grey--text" @click="reply">
                    <v-icon color="grey" small left>reply</v-icon>
                    Поделиться
                </v-btn>
                <template v-if="user">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn
                                    small
                                    class="grey--text"
                                    v-on="on"
                            >
                                Дополнительно
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-tile @click="">
                                <v-list-tile-title>Редактировать</v-list-tile-title>
                            </v-list-tile>
                            <v-list-tile @click="">
                                <v-list-tile-title>Удалить</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </template>
            </v-flex>
            <v-flex xs4>
                <v-layout align-center justify-end fill-height>
                    <span class="caption grey--text mr-2">
                        <v-icon small color="grey">favorite</v-icon>
                        {{ track.likes_count }}
                    </span>
                    <span v-if="comments" class="caption grey--text">
                        <v-icon small color="grey">textsms</v-icon>
                        {{ comments.count }}
                    </span>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-snackbar v-model="snackbar" color="green">
            Ссылка на трек скопирована в буфер обмена.
            <v-btn
                    dark
                    fab
                    icon
                    @click="snackbar = false"
            >
                <v-icon>close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-flex>
</template>

<script>
    export default {
        name: "BigTrackPanel",
        data() { return {
            snackbar: false,
            comment: null
        }},
        computed: {
            user() {
                return this.$store.getters.USER;
            },
            track() {
                return this.$store.getters.TRACK;
            },
            comments() {
                return this.$store.getters.TRACK_COMMENTS;
            }
        },
        methods: {
            like() {
                this.$store.dispatch('LIKE_TRACK', this.$route.params.link);
            },
            deleteLike() {
                this.$store.dispatch('DELETE_TRACK_LIKE', this.$route.params.link);
            },
            reply() {
                let tmp   = document.createElement('INPUT'),
                    focus = document.activeElement;

                tmp.value = window.location.href;

                document.body.appendChild(tmp);
                tmp.select();
                document.execCommand('copy');
                document.body.removeChild(tmp);
                focus.focus();
                this.snackbar = true;
            },
            sendComment() {
                axios.post(`/api/track/${this.$route.params.link}/comment`, {text: this.comment}).then(res => {
                    this.comment = null;
                    this.$store.dispatch('GET_TRACK_COMMENTS', this.$route.params.link);
                }).catch(error => {
                    console.log(error.response);
                });
            }
        }
    }
</script>

<style scoped>

</style>