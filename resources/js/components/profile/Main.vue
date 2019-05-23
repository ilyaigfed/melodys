<!--<template>-->
<!--    <v-flex xs12 v-if="profile" class="pr-2">-->
<!--        <v-card>-->
<!--            <v-img-->
<!--                    :src="profile.image ? '/storage/'+profile.image: '/storage/common/none-avatar.jpg'"-->
<!--                    aspect-ratio="1"-->
<!--                    class="white&#45;&#45;text"-->
<!--            >-->
<!--                <v-container fill-height fluid>-->
<!--                    <v-layout fill-height>-->
<!--                        <v-flex xs12 align-end flexbox>-->
<!--                            <span class="headline grey darken-3 pa-2">{{ profile.name }}</span>-->
<!--                        </v-flex>-->
<!--                    </v-layout>-->
<!--                </v-container>-->
<!--            </v-img>-->
<!--            <v-container class="text-xs-center grey lighten-4 grey&#45;&#45;text pa-3">-->
<!--                <v-layout>-->
<!--                        <v-flex xs4 class="caption under-avatar-hover">-->
<!--                            Подписчики-->
<!--                            <v-flex xs12 class="subheading">-->
<!--                                {{ profile.followers_count }}-->
<!--                            </v-flex>-->
<!--                        </v-flex>-->
<!--                    <v-flex xs4 class="caption under-avatar-hover">-->
<!--                        Подписки-->
<!--                        <v-flex xs12 class="subheading">-->
<!--                            {{ profile.followings_count }}-->
<!--                        </v-flex>-->
<!--                    </v-flex>-->
<!--                    <v-flex xs4 class="caption under-avatar-hover">-->
<!--                        Аудиофайлы-->
<!--                        <v-flex xs12 class="subheading">-->
<!--                            {{ profile.tracks_count }}-->
<!--                        </v-flex>-->
<!--                    </v-flex>-->
<!--                </v-layout>-->
<!--            </v-container>-->
<!--            <v-card-actions>-->
<!--                <template v-if="!showPersonalElements && user">-->
<!--                    <v-btn flat small color="orange" v-if="!profile.is_following" @click="follow(profile.user_id)">Подписаться</v-btn>-->
<!--                    <v-btn flat small color="orange" v-else @click="unfollow(profile.user_id)">Отписаться</v-btn>-->
<!--                </template>-->
<!--                <Edit v-if="showPersonalElements"></Edit>-->
<!--                <v-btn flat icon color="grey" @click="reply">-->
<!--                    <v-icon>reply</v-icon>-->
<!--                </v-btn>-->
<!--                <v-spacer></v-spacer>-->
<!--                <v-btn icon @click="showBio = !showBio" v-if="profile.about || profile.twitter || profile.website || profile.instagram">-->
<!--                    <v-icon color="grey">{{ showBio ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>-->
<!--                </v-btn>-->
<!--            </v-card-actions>-->
<!--            <v-slide-y-transition>-->
<!--                <v-flex v-show="showBio">-->
<!--                    <v-list two-line v-if="profile.instagram || profile.twitter || profile.website">-->
<!--                        <v-list-tile @click="goToInstagram" v-if="profile.instagram">-->
<!--                            <v-list-tile-content>-->
<!--                                <v-list-tile-title>@{{ profile.instagram }}</v-list-tile-title>-->
<!--                                <v-list-tile-sub-title>Instagram</v-list-tile-sub-title>-->
<!--                            </v-list-tile-content>-->
<!--                        </v-list-tile>-->

<!--                        <v-list-tile @click="goToTwitter" v-if="profile.twitter">-->
<!--                            <v-list-tile-content>-->
<!--                                <v-list-tile-title>@{{ profile.twitter }}</v-list-tile-title>-->
<!--                                <v-list-tile-sub-title>Twitter</v-list-tile-sub-title>-->
<!--                            </v-list-tile-content>-->
<!--                        </v-list-tile>-->

<!--                        <v-list-tile @click="goToWebsite" v-if="profile.website">-->
<!--                            <v-list-tile-content>-->
<!--                                <v-list-tile-title>{{ profile.website }}</v-list-tile-title>-->
<!--                                <v-list-tile-sub-title>Веб-сайт</v-list-tile-sub-title>-->
<!--                            </v-list-tile-content>-->
<!--                        </v-list-tile>-->
<!--                    </v-list>-->
<!--                    <template v-if="profile.about">-->
<!--                        <v-subheader>О себе</v-subheader>-->
<!--                        <v-card-text class="pt-0">-->
<!--                            {{ profile.about }}-->
<!--                        </v-card-text>-->
<!--                    </template>-->
<!--                </v-flex>-->
<!--            </v-slide-y-transition>-->
<!--        </v-card>-->
<!--        <v-snackbar-->
<!--                v-model="snackbar"-->
<!--                color="green"-->
<!--        >-->
<!--            Ссылка на профиль скопирована в буфер обмена.-->
<!--            <v-btn-->
<!--                    dark-->
<!--                    fab-->
<!--                    icon-->
<!--                    @click="snackbar = false"-->
<!--            >-->
<!--                <v-icon>close</v-icon>-->
<!--            </v-btn>-->
<!--        </v-snackbar>-->
<!--    </v-flex>-->
<!--</template>-->

<template>
    <v-flex style="max-height: 253px;">
        <v-layout class="pa-4" id="p-bg">
            <v-flex xs2>
                <v-img
                        :src="profile.image ? '/storage/'+profile.image: '/storage/common/none-avatar.jpg'"
                        aspect-ratio="1"
                        class="grey lighten-2"
                >
                </v-img>
            </v-flex>
            <v-flex xs8 class="pt-3 pl-4">
                <span class="black white--text headline pr-2 pl-2 pt-1 pb-1">{{ profile.name }}</span>
            </v-flex>
        </v-layout>
        <img :src="profile.image ? '/storage/'+profile.image: '/storage/common/none-avatar.jpg'" id="bad" v-show="false">
    </v-flex>
</template>

<script>
    import Edit from "./Edit";
    import FastAverageColor from 'fast-average-color';
    export default {
        name: "Main",
        components: {Edit},
        data() { return {
            showBio: false,
            snackbar: false
        }},
        computed: {
            user() {
                return this.$store.getters.USER;
            },
            profile() {
                return this.$store.getters.PROFILE;
            }
        },
        mounted() {
            const img = document.getElementById('bad');

            img.onload = function() {
                const fac = new FastAverageColor(),
                    bt_bg = document.getElementById('p-bg'),
                    color = fac.getColor(img);

                bt_bg.style.background = color.rgba;
            };
        },
        watch: {
        },
        methods: {
            goToInstagram() {window.open(`https://www.instagram.com/${this.profile.instagram}`);},
            goToTwitter() {window.open(`https://twitter.com/${this.profile.twitter}`);},
            goToWebsite() {window.open(this.profile.website);},
            follow(id) {this.$store.dispatch('FOLLOW', id);},
            unfollow(id) {this.$store.dispatch('UNFOLLOW', id);},
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
            }
        }
    }
</script>

<style scoped>
    .under-avatar-hover {
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: 200ms color;
    }
    .under-avatar-hover:hover {
        color: #424242;
    }
</style>