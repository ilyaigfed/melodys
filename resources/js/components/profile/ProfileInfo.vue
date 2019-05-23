<template>
    <v-flex xs12 class="pl-3 pr-3">
        <v-layout>
            <v-flex xs12>
                <v-card class="pt-4 pb-4">
                    <v-layout row wrap justify-center class="text-xs-center  caption font-weight-thin pb-4 grey--text text--darken-1">
                        <v-flex xs4 @click="$router.push({ name: 'publications-tracks' })" style="cursor: pointer;">
                            <span>Треки</span><br/>
                            <span class="body-2">{{ profile.tracks_count }}</span>
                        </v-flex>
                        <v-flex xs4 @click="$router.push({ name: 'interaction-followers' })" style="cursor: pointer;">
                            <span>Подписчики</span><br/>
                            <span class="body-2">{{ profile.followers_count }}</span>
                        </v-flex>
                        <v-flex xs4 @click="$router.push({ name: 'interaction-followings' })" style="cursor: pointer;">
                            <span>Подписки</span><br/>
                            <span class="body-2">{{ profile.followings_count }}</span>
                        </v-flex>
                    </v-layout>
                        <v-divider></v-divider>
                        <v-layout row wrap class="grey--text text--darken-3">
                            <v-flex xs12>
                                <v-list
                                        two-line
                                >
                                    <v-list-tile @click="toInsta" v-if="profile.instagram">
                                        <v-list-tile-content>
                                            <v-list-tile-title>@{{ profile.instagram }}</v-list-tile-title>
                                            <v-list-tile-sub-title>Instagram</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile @click="toTwitter" v-if="profile.twitter">
                                        <v-list-tile-content>
                                            <v-list-tile-title>@{{ profile.twitter }}</v-list-tile-title>
                                            <v-list-tile-sub-title>Twitter</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile @click="toWebsite" v-if="profile.website">
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{ profile.website }}</v-list-tile-title>
                                            <v-list-tile-sub-title>Веб-сайт</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                                <template v-if="profile.about">
                                    <v-divider></v-divider>
                                    <v-subheader>Биография</v-subheader>

                                    <div class="pr-3 pl-3">{{ profile.about }}</div>

                                </template>
                            </v-flex>
                        </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
    export default {
        name: 'ProfileInfo',
        data() { return {
            
        }},
        computed: {
            profile() {
                return this.$store.getters.PROFILE;
            }
        },
        methods: {
            toInsta() {
                window.open('https://www.instagram.com/'+this.profile.instagram);
            },
            toTwitter() {
                window.open('https://twitter.com/'+this.profile.twitter);
            },
            toWebsite() {
                window.open(this.profile.website);
            }
        }
    }
</script>

<style scoped>

</style>


