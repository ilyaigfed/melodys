<template>
    <v-layout row wrap align-center justify-center class="mt-5">
        <v-flex xs6 class="text-xs-center">
            <v-layout column class="mb-4">
                <span class="title">Пароль успешно сброшен.</span>
                <span class="subheading">Новый пароль будет отправлен на Ваш email.</span>
            </v-layout>
            <v-progress-circular
                    indeterminate
                    color="amber"
            ></v-progress-circular>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "PasswordReset",
        created() {
            if(!this.$route.params.token) {
                this.$router.push({name:'not-found'});
            }
        },
        mounted() {
            if(this.$route.params.token) {
                axios.get(`/api/user/password_reset?token=${this.$route.params.token}`).then(res => {
                    this.$router.push({name:'home'});
                }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>

</style>