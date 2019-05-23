<template>
    <v-card class="mt-5 mb-5">
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
                            <v-btn dark icon class="hidden-file-container" @click="openFile(i)">
                                <v-icon>add_a_photo</v-icon>
                            </v-btn>
                            <input class="edit-track-image" :id="'edit-track-image-'+i" type="file" @change="changeImage">
                        </v-card-title>
                    </v-layout>
                </v-img>
            </v-flex>
            <v-flex xs7>
                <v-card-title primary-title>
                    <div>
                        <div class="caption">{{ file.file.name }}</div>
                    </div>
                </v-card-title>
                <v-card-text>
                    <v-flex xs12>
                        <v-text-field label="Название" color="orange" v-model="file_title"></v-text-field>
                    </v-flex>
                    <v-flex xs6 class="pr-1">
                        <v-select
                                v-model="file_genre_id"
                                :items="genres"
                                item-text="name"
                                item-value="id"
                                label="Жанр"
                                color="orange"
                                chips
                                deletable-chips
                        ></v-select>
                    </v-flex>
                    <v-flex xs12>
                        <v-textarea label="Описание" color="orange" v-model="file_description"></v-textarea>
                    </v-flex>
                </v-card-text>
            </v-flex>
        </v-layout>
        <v-divider light></v-divider>
        <v-card-actions class="pa-3">
            <v-spacer></v-spacer>
            <v-btn flat color="grey" @click="cancel" :disabled="!!progress">Отменить</v-btn>
            <v-btn flat color="success" @click="upload" :disabled="!!progress">Загрузить</v-btn>
        </v-card-actions>
        <transition name="fade">
            <v-card-actions v-show="progress">
                <v-progress-linear
                        color="green"
                        :indeterminate="query"
                        height="2"
                        v-model="progress"
                ></v-progress-linear>
            </v-card-actions>
        </transition>
    </v-card>
</template>

<script>
    export default {
        name: "FileCard",
        data() { return {
            image_src: null,
            progress: null,
            query: false
        }},
        props: ['file', 'i'],
        computed: {
            calculated_image_src() {
                if(this.file_image) {
                    return URL.createObjectURL(this.file_image);
                }
                if(this.image_src) {
                    return this.image_src;
                } else return '/siteimages/blurred-track-ava.jpg';
            },
            user() {
                return this.$store.getters.USER;
            },
            genres() {
                return this.$store.getters.GENRES;
            },
            file_title: {
                get() {
                    return this.$store.state.files[this.i].title;
                },
                set(value) {
                    this.$store.commit('SET_FILE_PROP', {key: this.i, prop: 'title', data: value});
                }
            },
            file_description: {
                get() {
                    return this.$store.state.files[this.i].description;
                },
                set(value) {
                    this.$store.commit('SET_FILE_PROP', {key: this.i, prop: 'description', data: value});
                }
            },
            file_playlist_id: {
                get() {
                    return this.$store.state.files[this.i].playlist_id;
                },
                set(value) {
                    this.$store.commit('SET_FILE_PROP', {key: this.i, prop: 'playlist_id', data: value});
                }
            },
            file_genre_id: {
                get() {
                    return this.$store.state.files[this.i].genre_id;
                },
                set(value) {
                    this.$store.commit('SET_FILE_PROP', {key: this.i, prop: 'genre_id', data: value});
                }
            },
            file_image: {
                get() {
                    return this.$store.state.files[this.i].image;
                },
                set(value) {
                    this.$store.commit('SET_FILE_PROP', {key: this.i, prop: 'image', data: value});
                }
            }
        },
        methods: {
            changeImage(e) {
                const file = e.target.files[0];

                if(file.type === 'image/png' || file.type === 'image/jpeg') {
                    this.image_src = URL.createObjectURL(file);
                    this.file_image = file;
                    e.target.value = null;
                }
            },
            openFile(key) {
                document.getElementById('edit-track-image-'+key).click();
            },
            upload() {
                let form_data = new FormData();

                for(const prop in this.file) {
                    if(this.file[prop]) {
                        form_data.set(prop, this.file[prop]);
                    }
                }

                const config = {
                    onUploadProgress: (e) => {
                        this.progress = Math.floor((e.loaded * 100) / e.total);

                        if(this.progress === 100) this.query = true;
                    }
                };

                axios.post('/api/track', form_data, config).then(res => {
                    this.$store.commit('DELETE_FILE', this.i);
                    this.$store.dispatch('GET_AVAILABLE_DURATION');
                    this.query = false;
                    this.progress = null;
                }).catch(err => {
                    console.log(err.response);
                    this.query = false;
                    this.progress = null;
                    throw new Error('Что-то пошло не так при загрузке аудиофайла ('+err.response.status+')');
                });
            },
            cancel() {
                this.$store.dispatch('CANCEL_FILE', this.i);
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