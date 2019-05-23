<template>
    <v-flex xs3 class="pt-4" :class="'pr-4'">
        <v-hover>
            <v-card flat @click="openPlaylist(playlist.link)" style="cursor: pointer;" slot-scope="{ hover }"
                    :class="`elevation-${hover ? 12 : 0}`">
                <v-img
                        :src="playlist.image ? '/storage/'+playlist.image: '/siteimages/blurred-track-ava.jpg'"
                        aspect-ratio="1"
                >
                    <v-container
                            fill-height
                            fluid
                            pa-2
                    >
                        <v-layout class="text-xs-right">
                            <v-flex xs12>
                                <v-chip :class="`show-chip-${hover ? 1: 0}`"
                                        label
                                        color="orange"
                                        text-color="white"
                                >{{ playlist.playlist_type }}</v-chip>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-img>
                <v-card-actions>
                    <span class="font-weight-regular">{{ playlist.title }}</span>
                </v-card-actions>
            </v-card>
        </v-hover>
    </v-flex>
</template>

<script>
    export default {
        name: "Playlist",
        props: ['playlist', 'i'],
        methods: {
            openPlaylist(link) {
                this.$router.push('/playlists/'+link);
            }
        }
    }
</script>

<style scoped>
    .show-chip-0 {
        opacity: 0;
    }

    .show-chip-1 {
        opacity: 1;
    }
</style>