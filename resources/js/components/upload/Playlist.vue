<template>
    <v-flex xs10 lg8>
        <v-card class="mt-5">
            <v-layout>
                <v-flex xs5>
                    <v-img
                            :src="calculated_image_src"
                            aspect-ratio="1"
                            class="ma-4"
                    >
                        <v-layout
                                column
                                fill-height
                        >
                            <v-card-title>
                                <v-btn dark icon class="hidden-file-container" @click="openFile">
                                    <v-icon>add_a_photo</v-icon>
                                </v-btn>
                                <input class="edit-track-image" id="edit-playlist-image" type="file" @change="changeImage">
                            </v-card-title>
                        </v-layout>
                    </v-img>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-text-field label="Название" color="orange" v-model="playlist.title"></v-text-field>
                            </v-flex>
                            <v-flex xs6 class="pr-1">
                                <v-select
                                        v-model="playlist.genre_id"
                                        :items="genres"
                                        item-text="name"
                                        item-value="id"
                                        label="Жанр"
                                        color="orange"
                                        chips
                                        deletable-chips
                                ></v-select>
                            </v-flex>
                            <v-flex xs6 class="pl-1">
                                <v-select
                                        v-model="playlist.playlist_type_id"
                                        :items="playlist_types"
                                        item-text="name"
                                        item-value="id"
                                        label="Тип"
                                        color="orange"
                                        chips
                                        deletable-chips
                                ></v-select>
                            </v-flex>
                            <v-flex xs6 class="pr-1">
                                <v-menu
                                        ref="menu"
                                        v-model="menu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="playlist.release_date"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                                v-model="playlist.release_date"
                                                label="Дата релиза"
                                                readonly
                                                v-on="on"
                                                color="orange"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                            v-model="playlist.release_date"
                                            no-title
                                            scrollable
                                            :first-day-of-week="1"
                                            locale="ru-ru"
                                            color="orange"
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn flat color="grey" @click="menu = false">Отменить</v-btn>
                                        <v-btn flat color="success" @click="$refs.menu.save(playlist.release_date)">ОК</v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12>
                                <v-textarea label="Описание" color="orange" v-model="playlist.description"></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-flex>
            </v-layout>
            <v-divider light></v-divider>
            <v-card-actions class="pa-3">
                <v-spacer></v-spacer>
                <v-btn flat color="grey" @click="cancel">Отменить</v-btn>
                <v-btn flat color="success" @click="upload">Загрузить</v-btn>
            </v-card-actions>
            <v-divider></v-divider>
            <FileList></FileList>
        </v-card>
    </v-flex>
</template>

<script>
    import FileList from "./FileList";
    export default {
        name: "Playlist",
        components: {FileList},
        data() { return {
            playlist: {
                title: null,
                link: null,
                description: null,
                image: null,
                playlist_type_id: null,
                genre_id: null,
                release_date: null
            },
            image_src: null,
            menu: null,
        }},
        computed: {
            genres() {
                return this.$store.getters.GENRES;
            },
            playlist_types() {
                return this.$store.getters.PLAYLIST_TYPES;
            },
            calculated_image_src() {
                if(this.image_src) {
                    return this.image_src;
                } else return '/siteimages/blurred-track-ava.jpg';
            },
            user() {
                return this.$store.getters.USER;
            }
        },
        methods: {
            changeImage(e) {
                const file = e.target.files[0];

                if(file.type === 'image/jpeg' || file.type === 'image/png') {
                    this.image_src = URL.createObjectURL(file);
                    this.playlist.image = file;
                    e.target.value = null;
                }
            },
            openFile() {
                document.getElementById('edit-playlist-image').click();
            },
            cancel() {
                this.$store.dispatch('CANCEL_ALL_FILES');
            },
            upload() {
                let form_data = new FormData();

                for(const prop in this.playlist) {
                    if(this.playlist[prop]) {
                        form_data.set(prop, this.playlist[prop]);
                    }
                }

                this.$store.dispatch('UPLOAD_PLAYLIST_WITH_FILES', form_data);
            }
        }
    }
</script>

<style scoped>
    .edit-track-image {
        display: none;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>