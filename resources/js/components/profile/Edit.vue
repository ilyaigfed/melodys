<template>
    <v-dialog v-model="showed" persistent max-width="720px">
        <template v-slot:activator="{ on }">
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn small flat icon color="grey" v-on="on" @click="open">
                        <v-icon>edit</v-icon>
                    </v-btn>
                </template>
                <span>Редактировать</span>
            </v-tooltip>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Редактирование профиля</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap justify-space-between>
                        <v-flex xs5>
                            <transition name="fade">
                            <v-img
                                    :src="calculated_image_src"
                                    aspect-ratio="1"
                                    class="white--text"
                                    v-on:load="onLoaded"
                                    v-show="image_is_loaded"
                            >
                                <v-layout
                                        column
                                        fill-height
                                >
                                    <v-card-title>
                                            <v-btn dark icon class="hidden-file-container">
                                                <v-icon>add_a_photo</v-icon>
                                            </v-btn>
                                        <label for="edit-profile-image" class="hidden-file">
                                        </label>
                                        <input id="edit-profile-image" type="file" @change="changeImage">
                                    </v-card-title>
                                </v-layout>
                            </v-img>
                            </transition>
                        </v-flex>
                        <v-flex xs6>
                            <v-layout wrap row>
                                <v-flex xs12>
                                    <v-text-field label="Никнейм" color="orange" v-model="profile_clone.name"></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field label="https://melodys.com/profile/..." color="orange" v-model="profile_clone.link"></v-text-field>
                                </v-flex>
                                <v-flex xs6>
                                    <v-text-field label="Instagram" color="orange" v-model="profile_clone.instagram"></v-text-field>
                                </v-flex>
                                <v-flex xs6>
                                    <v-text-field label="Twitter" color="orange" v-model="profile_clone.twitter"></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field label="Веб-сайт" color="orange" v-model="profile_clone.website"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex xs12>
                            <v-textarea
                                    label="О себе"
                                    v-model="profile_clone.about"
                                    color="orange"
                            ></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey" flat @click="close">Отменить</v-btn>
                <v-btn color="success" flat @click="edit">Сохранить</v-btn>
                <v-progress-circular
                        indeterminate
                        color="green"
                        v-show="edit_profile_loading"
                ></v-progress-circular>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "Edit",
        data() { return {
            profile_clone: {
                name: null,
                link: null,
                instagram: null,
                twitter: null,
                website: null,
                image: null,
                about: null
            },
            image_value: null,
            image_src: null,
            image_is_loaded: false
        }},
        computed: {
            profile() {
                return this.$store.getters.PROFILE;
            },
            showed() {
                return this.$store.getters.EDIT_PROFILE_IS_SHOWED;
            },
            calculated_image_src()
            {
                if(this.image_src) {
                    return this.image_src;
                } else if(this.profile_clone.image) {
                    return '/storage/'+this.profile_clone.image;
                } else {
                    return '/storage/common/none-avatar.jpg';
                }
            },
            edit_profile_loading() {
                return this.$store.getters.EDIT_PROFILE_LOADING;
            }
        },
        mounted() {
            //this.init();
        },
        methods: {
            close() {
                this.$store.dispatch('CHANGE_EDIT_PROFILE_IS_SHOWED', false);
                },
            open() {
                this.init();
                this.$store.dispatch('CHANGE_EDIT_PROFILE_IS_SHOWED', true);
            },
            edit() {
                let form_data = new FormData();

                for (let prop in this.profile_clone) {
                    if(this.profile_clone[prop] !== this.profile[prop]) {
                        form_data.set(prop, this.profile_clone[prop]);
                    }
                }

                if(this.image_value) {
                    form_data.append('image', this.image_value);
                }

                this.$store.dispatch('EDIT_PROFILE', form_data);
            },
            changeImage(e) {
                this.image_is_loaded = false;
                const file = e.target.files[0];
                this.image_src = URL.createObjectURL(file);
                this.image_value = file;
                e.target.value = null;
            },
            onLoaded() {
                this.image_is_loaded = true;
            },
            init() {
                for (let prop in this.profile_clone) {
                    this.profile_clone[prop] = this.profile[prop];
                }
                this.image_src = null;
            }
        }
    }
</script>

<style scoped>
    .hidden-file {
        background: rgba(255,255,255,0);
        cursor: pointer;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #edit-profile-image {
        display: none;
    }

    .fade-enter-active {
        transition: opacity 0.5s ease-in-out;
    }

    .fade-enter-to {
        opacity: 1;
    }

    .fade-enter {
        opacity: 0;
    }
</style>