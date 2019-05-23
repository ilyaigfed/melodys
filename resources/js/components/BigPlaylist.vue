<template>
    <v-layout v-if="playlist" row wrap justify-center align-center class="bg-track-header" :style="{background: playlist.image ? 'url(/storage/'+playlist.image+')': 'url(/siteimages/blurred-track-ava.jpg)'}">
        <v-flex xs8>
            <v-card>
                <v-layout row wrap>
                    <v-flex xs6>
                        <v-flex xs12 class="pt-3 pl-3 pr-3">
                            <v-img
                                    :src="playlist.image ? '/storage/'+playlist.image: '/siteimages/blurred-track-ava.jpg'"
                                    aspect-ratio="1"
                            >
                                <v-container fill-height fluid>
                                    <v-layout fill-height>
                                        <v-flex xs12 align-end flexbox>
                                <span class="black white--text subheading pr-2 pl-2 pt-1 pb-1"
                                      @click="$router.push(`/profile/${playlist.user.link}`)"
                                      style="cursor: pointer;"
                                >{{ playlist.user.name }}</span>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-img>
                        </v-flex>
                        <v-card-title primary-title>
                            <div>
                                <h3 class="headline mb-0">{{ playlist.title }}</h3>
                                <div> {{ playlist.description }} </div>
                            </div>
                        </v-card-title>
                        <v-card-actions>
                            <v-btn flat color="orange">Слушать</v-btn>
                            <v-btn flat color="orange" @click="reply">Поделиться</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn v-if="playlist.liked" small flat color="info" @click="deleteLike">
                                <v-icon color="info">favorite</v-icon>
                                {{ playlist.likes_count }}
                            </v-btn>
                            <v-btn :disabled="!user" v-if="!playlist.liked" small flat color="grey" @click="like">
                                <v-icon color="grey">favorite</v-icon>
                                {{ playlist.likes_count }}
                            </v-btn>
                        </v-card-actions>
                    </v-flex>
                    <v-flex xs6>
                        <v-list style="width: 100%">
                            <v-list-tile
                                    :to="'/tracks/'+track.link"
                                    avatar
                                    v-for="(track, i) in playlist.tracks"
                                    :key="i"
                            >
                                <v-list-tile-action>
                                    <v-btn icon>
                                        <v-icon color="orange">play_arrow</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title class="body-2 font-weight-regular" v-text="track.title"></v-list-tile-title>
                                    <v-list-tile-title class="caption grey--text">{{ track.duration | minutes }}</v-list-tile-title>
                                </v-list-tile-content>
                                <v-list-tile-avatar>
                                    <img :src="track.image ? '/storage/'+track.image: '/siteimages/blurred-track-ava.jpg'">
                                </v-list-tile-avatar>
                            </v-list-tile>
                        </v-list>
                    </v-flex>
                </v-layout>
            </v-card>
        </v-flex>
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
    </v-layout>
</template>

<script>
    export default {
        name: "BigPlaylist",
        data() { return {
            snackbar: false
        }},
        computed: {
            playlist() {
                return this.$store.getters.PLAYLIST;
            },
            user() {
                return this.$store.getters.USER;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PLAYLIST', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_PLAYLIST', null);
        },
        methods: {
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
            like() {
                this.$store.dispatch('LIKE_PLAYLIST', this.$route.params.link);
            },
            deleteLike() {
                this.$store.dispatch('DELETE_PLAYLIST_LIKE', this.$route.params.link);
            }
        }
    }
</script>

<style scoped>
    .bg-track-header {
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        background-position: center !important;
        position: relative;
    }

    .bg-track-header::before {
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.71);
    }
</style>