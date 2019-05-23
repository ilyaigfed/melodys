<template>
    <v-flex xs10 lg8>
        <v-card class="pa-5" @drop.prevent="loadFiles" @dragover.prevent style="border: 2px dashed #dddddd" flat>
            <v-container align-center justify-center class="text-xs-center">
                <v-card-text>
                    <span class="text-lg-center headline font-weight-thin">Перетащите аудиофайлы сюда</span>
                </v-card-text>
                <v-btn color="success" @click="openFiles">
                    Или выберите
                    <input id="upload-file" type="file" multiple @change="loadFiles">
                </v-btn>
                <v-checkbox v-show="!files"
                            v-model="make_playlist"
                            label="Создать плейлист при выборе нескольких аудиофайлов"
                ></v-checkbox>
            </v-container>
            <template v-if="available_duration !== -1">
                <transition name="fade">
                    <v-card-actions v-show="!files">
                        <v-btn outline color="orange">PRO</v-btn>
                        <v-card-text>
                            <span class="grey--text">Pro-аккаунт позволяет загружать неограниченное количество аудиофайлов.</span>
                        </v-card-text>
                    </v-card-actions>
                </transition>
                <v-card-text class="text-xs-center">
                    <span class="caption grey--text">Доступно минут: {{ available_duration }}.</span>
                </v-card-text>
            </template>
        </v-card>
    </v-flex>
</template>

<script>
    export default {
        name: "Choose",
        data() { return {

        }},
        watch: {
            '$route'() {
                this.init();
            }
        },
        mounted() {
            this.init();
        },
        computed: {
            available_duration() {
                return this.$store.getters.AVAILABLE_DURATION;
            },
            files() {
                return this.$store.getters.FILES;
            },
            make_playlist: {
                set(x) {
                    this.$store.commit('SET_MAKE_PLAYLIST', x);
                },
                get() {
                    return this.$store.getters.MAKE_PLAYLIST;
                }
            }
        },
        methods: {
            loadFiles(e) {
                const the_way = e.dataTransfer || e.target;

                let files = Array.prototype.slice.call(the_way.files);
                let _files = [];

                for(let i = 0; i < files.length; i++) {
                    if(files[i].type === 'audio/mp3') {
                        _files.push(files[i]);
                    }
                }

                this.$store.dispatch('ADD_FILES', _files);

                if(the_way.value) the_way.value = null;
            },
            openFiles() {
                document.getElementById('upload-file').click();
            },
            init() {
                this.$store.dispatch('GET_AVAILABLE_DURATION');
            }
        }
    }
</script>

<style scoped>
    #upload-file {
        display: none;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>