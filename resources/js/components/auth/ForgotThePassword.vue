<template>
    <v-dialog v-model="showed" persistent max-width="400px" hide-overlay
              transition="dialog-transition">
        <template v-slot:activator="{ on }">
            <v-btn flat color="grey" @click="showed = true">Забыли пароль?</v-btn>
        </template>
        <v-card>
            <form>
                <v-card-title>
                    <span class="headline">Сброс пароля</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-alert
                                    :value="alert"
                                    type="success"
                                    transition="scale-transition"
                            >
                                Ссылка для сброса пароля отправлена на указанный Вами адрес.
                            </v-alert>
                            <v-flex xs12>
                                <v-text-field
                                        label="Email"
                                        color="orange"
                                        v-model="email"
                                        type="text"
                                        required
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="grey" flat @click="showed = false">Закрыть</v-btn>
                    <v-btn color="success" flat @click="passwordRecovery">Сбросить пароль</v-btn>
                </v-card-actions>
            </form>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "ForgotThePassword",
        data() { return {
            showed: false,
            email: null,
            alert: false
        }},
        methods: {
            passwordRecovery() {
                axios.post('/api/user/password_recovery', {email:this.email}).then(res => {
                    this.email = null;
                    this.alert = true;
                    setTimeout(() => {
                        this.alert = false;
                        this.showed = false;
                    }, 5000);
                }).catch(error => {
                    console.log(error.response);
                });
            }
        }
    }
</script>

<style scoped>

</style>