<template>
    <v-flex xs12>
        <v-layout row align-center justify-space-between>
            <v-subheader>Фотографии</v-subheader>
            <v-btn color="grey" flat small @click="openToChoose" v-if="show_personal_elements">Добавить</v-btn>
            <input type="file" id="profile-photo-input" style="display: none;" @change="showThePhoto">
        </v-layout>
        <v-flex xs12 v-if="_photos && _photos.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">photo_size_select_actual</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <v-carousel :hide-controls="_photos.length <= 4" hide-delimiters height="auto" style="box-shadow: none;" v-if="_photos && _photos.length > 0" :cycle="true">
            <v-carousel-item v-for="(photo, i) in photos" :key="i">
                <v-layout row wrap>
                    <ImageWindow v-for="(item, i) in photo" :key="i" :item="item"></ImageWindow>
                </v-layout>
            </v-carousel-item>
        </v-carousel>
        <v-flex xs12 class="text-xs-center" v-if="!_photos">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-dialog v-model="dialog" persistent max-width="600">
            <v-card>
                <v-card-title class="headline">Загрузка фотографии</v-card-title>
                <v-card-text v-if="img_src">
                    <v-img
                            :src="img_src"
                            aspect-ratio="1.7"
                    >
                    </v-img>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="grey" flat @click="dialog = false">Отменить</v-btn>
                    <v-btn color="green" flat @click="upload">Загрузить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-flex>
</template>

<script>
    import ImageWindow from "./carou/ImageWindow";
    export default {
        name: "Carou",
        components: {ImageWindow},
        data() { return {
            dialog: false,
            img_src: null,
            img_value: null
        }},
        mounted() {
            this.$store.dispatch('GET_PROFILE_PHOTOS', this.$route.params.link);
        },
        computed: {
            photos() {
                const size = 4,
                    photos = this.$store.getters.PROFILE_PHOTOS;
                let arr = [];

                for (let i = 0; i < Math.ceil(photos.length/size); i++){
                    arr[i] = photos.slice((i*size), (i*size) + size);
                }
                return arr;
            },
            _photos() {
                return this.$store.getters.PROFILE_PHOTOS;
            },
            user() {
                return this.$store.getters.USER;
            },
            profile() {
                return this.$store.getters.PROFILE;
            },
            show_personal_elements() {
                if(this.user && this.profile) {
                    return this.user.link === this.profile.link;
                }
            }
        },
        methods: {
            openToChoose() {document.getElementById('profile-photo-input').click();},
            showThePhoto(e) {
                const file = e.target.files[0];
                this.img_src = URL.createObjectURL(file);
                this.img_value = file;
                e.target.value = null;
                this.dialog = true;
            },
            upload() {
                let form_data = new FormData();
                form_data.set('image', this.img_value);
                this.$store.dispatch('UPLOAD_PROFILE_PHOTO', { data: form_data, link: this.$route.params.link });
                this.dialog = false;
            }
        }
    }
</script>

<style scoped>

</style>