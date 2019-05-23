<template>
    <v-flex xs12>
        <v-tabs slider-color="orange" active-class="">
            <v-tab
                    v-for="(link, i) in links"
                    :key="i"
                    :to="link.to"
            >
                {{ link.name }}
            </v-tab>
        </v-tabs>
    </v-flex>
</template>

<script>
    export default {
        name: "PublicationsNavigation",
        data() { return {
            links: [
                { name: 'Общее', to: { name: 'publications-all' } },
                { name: 'Треки', to: { name: 'publications-tracks' } },
                { name: 'Альбомы', to: { name: 'publications-albums' } },
                { name: 'Плейлисты', to: { name: 'publications-playlists' } }
            ]
        }}
    }
</script>

<style scoped>
    
</style>