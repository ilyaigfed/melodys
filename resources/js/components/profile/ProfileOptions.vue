<template>
    <v-flex xs12 v-if="profile" fill-height>
        <v-layout justify-end align-center fill-height>
            <template v-if="!show_personal_elements && user">
                <v-btn small color="warning" v-if="!profile.is_following" @click="follow">Подписаться</v-btn>
                <v-btn small color="warning" v-else @click="unfollow">Отписаться</v-btn>
            </template>
            <Edit v-if="show_personal_elements"></Edit>
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn flat small icon color="grey" v-on="on" @click="reply">
                        <v-icon>reply</v-icon>
                    </v-btn>
                </template>
                <span>Поделиться</span>
            </v-tooltip>
        </v-layout>
        <v-snackbar v-model="snackbar" color="green">
            Ссылка на профиль скопирована в буфер обмена.
            <v-btn
                    dark
                    fab
                    icon
                    @click="snackbar = false"
            >
                <v-icon>close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-flex>
</template>

<script>
    import Edit from "./Edit";
    export default {
        name: "ProfileOptions",
        components: {Edit},
        data() { return {
            snackbar: false
        }},
        computed: {
            profile() {
                return this.$store.getters.PROFILE;
            },
            user() {
                return this.$store.getters.USER;
            },
            show_personal_elements() {
                if(this.user && this.profile) {
                    return this.user.link === this.profile.link;
                }
            },
        },
        methods: {
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
            },
            follow() {this.$store.dispatch('FOLLOW', this.profile.user_id);},
            unfollow() {this.$store.dispatch('UNFOLLOW', this.profile.user_id);},
        }
    }
</script>

<style scoped>

</style>