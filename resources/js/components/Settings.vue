<template>
    <v-layout row wrap class="pa-3">
        <v-flex xs12 class="mb-4">
            <span class="display-1 font-weight-light">Настройки</span>
        </v-flex>
        <transition name="fade">
            <v-layout v-if="_settings" row wrap>
                <v-flex xs12>
                    <v-subheader>Внешний вид профиля</v-subheader>
                    <v-checkbox
                            color="orange"
                            v-model="settings.show_profile_photos"
                            label="Показывать фотографии профиля"
                    ></v-checkbox>
                    <v-checkbox
                            color="orange"
                            v-model="settings.show_profile_posts"
                            label="Показывать записи профиля"
                    ></v-checkbox>
                </v-flex>
                <v-flex xs4>
                    <v-subheader>Смена пароля</v-subheader>
                    <v-text-field type="password" v-model="password.password" color="orange" label="Новый пароль"></v-text-field>
                    <v-text-field type="password" v-model="password.r_password" color="orange" label="Повтор пароля"></v-text-field>
                    <v-layout justify-end>
                        <v-btn small @click="changePassword">Сменить</v-btn>
                    </v-layout>
                </v-flex>
                <v-flex xs12>
                    <v-subheader>Приватность</v-subheader>
                    <v-checkbox
                            color="orange"
                            v-model="settings.posts_only_from_me"
                            label="Оставлять записи профиля могу только я"
                    ></v-checkbox>
                </v-flex>
                <v-flex xs12>
                    <v-subheader>Аккаунт</v-subheader>
                    <v-btn color="red" small flat @click="deleteAccount">Удалить аккаунт</v-btn>
                </v-flex>
                <v-flex xs12 class="pt-5">
                    <v-btn @click="update">Сохранить</v-btn>
                </v-flex>
            </v-layout>
        </transition>
        <v-flex xs12 class="text-xs-center" v-if="!_settings">
            <v-progress-circular
                    :size="50"
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "Settings",
        data() { return {
            settings: {
                show_profile_photos: null,
                show_profile_posts: null,
                posts_only_from_me: null
            },
            password: {
                password: null,
                r_password: null
            }
        }},
        computed: {
            _settings() {
                return this.$store.getters.SETTINGS;
            }
        },
        watch: {
            _settings() {
                this.settings.show_profile_photos = this._settings.show_profile_photos;
                this.settings.show_profile_posts = this._settings.show_profile_posts;
                this.settings.posts_only_from_me = this._settings.posts_only_from_me;
            }
        },
        methods: {
            update() {
                this.$store.dispatch('UPDATE_SETTINGS', this.settings);
            },
            deleteAccount() {
                if(confirm('Ваш аккаунт будет удалён, но с возможностью восстановления через администрацию сервиса.\nВы согласны?')) {
                    axios.delete('/api/user/me').then(res => {
                        localStorage.removeItem('user');
                        localStorage.removeItem('token');
                        this.$store.commit('SET_USER', null);
                        this.$store.commit('SET_TOKEN', null);
                        this.$router.push({ name: 'home' });
                    }).catch(error => {

                    });
                }
            },
            changePassword() {
                axios.put('/api/user/me/password', this.password).then(res => {
                    this.password.password = null;
                    this.password.r_password = null;
                }).catch(error => {

                });
            }
        },
        mounted() {
            this.$store.dispatch('GET_SETTINGS');
        },
        destroyed() {
            this.$store.commit('SET_SETTINGS', null);
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>