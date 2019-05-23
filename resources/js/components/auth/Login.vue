<template>
        <v-dialog v-model="showed" persistent max-width="400px">
            <template v-slot:activator="{ on }">
                <v-btn flat @click="open">Вход</v-btn>
            </template>
            <v-card>
                <form>
                    <v-card-title>
                        <span class="headline">Вход</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field
                                            label="Email"
                                            v-validate="'required|email'"
                                            :error-messages="errors.collect('email')"
                                            data-vv-name="email"
                                            color="orange"
                                            v-model="email"
                                            type="text"
                                            required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field
                                            label="Пароль"
                                            type="password"
                                            color="orange"
                                            required
                                            v-model="password"
                                            v-validate="'required'"
                                            :error-messages="errors.collect('password')"
                                            data-vv-name="password"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <ForgotThePassword></ForgotThePassword>
                        <v-spacer></v-spacer>
                        <v-btn color="grey" flat @click="close">Закрыть</v-btn>
                        <v-btn color="success" flat @click="login">Войти</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
</template>

<script>
    import {login} from '../../helpers/auth';
    import ForgotThePassword from "./ForgotThePassword";
    export default {
        name: "Login",
        components: {ForgotThePassword},
        data() { return {
            showed: false,
            email: null,
            password: null,
            dictionary: {
                custom: {
                    email: {
                        required: 'Email не может быть пустым.',
                        email: 'Поле не соответствует формату email.'
                    },
                    password: {
                        required: 'Пароль не может быть пустым.'
                    }
                }
            }
        }},
        computed: {

        },
        mounted() {
            this.$validator.localize('ru', this.dictionary);
        },
        methods: {
            close() {
                this.showed = false;
                this.email = null;
                this.password = null;
                this.$validator.reset();
            },
            open() {this.showed = true;},
            async login() {
                const res = await this.$validator.validateAll();

                if(res) {
                    login({email: this.email, password: this.password}).then(res => {
                        this.$store.dispatch('LOGIN', res);
                        this.showed = false;
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>