<template>
    <v-dialog v-model="showed" persistent max-width="400px">
        <template v-slot:activator="{ on }">
            <v-btn flat @click="open">Регистрация</v-btn>
        </template>
        <v-card>
            <form>
                <v-card-title>
                    <span class="headline">Регистрация</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field
                                        label="Никнейм"
                                        type="text"
                                        color="orange"
                                        required
                                        v-model="name"
                                        v-validate="'required|max:30'"
                                        :error-messages="errors.collect('name')"
                                        data-vv-name="name"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field
                                        label="Email"
                                        required
                                        color="orange"
                                        v-model="email"
                                        v-validate="'required|email'"
                                        :error-messages="errors.collect('email')"
                                        data-vv-name="email"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field
                                        label="Пароль"
                                        type="password"
                                        color="orange"
                                        required
                                        v-model="password"
                                        v-validate="'required|min:8|max:50'"
                                        :error-messages="errors.collect('password')"
                                        data-vv-name="password"
                                        ref="password"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field
                                        label="Повтор пароля"
                                        type="password"
                                        color="orange"
                                        required
                                        v-model="r_password"
                                        v-validate="'required|confirmed:password'"
                                        :error-messages="errors.collect('r_password')"
                                        data-vv-name="r_password"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-checkbox
                                        v-model="terms"
                                        label="Я принимаю согласие с правилами проекта"
                                        color="orange"
                                        v-validate="'required'"
                                        :error-messages="errors.collect('terms')"
                                        data-vv-name="terms"
                                        type="checkbox"
                                        value="1"
                                        required
                                ></v-checkbox>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="grey" flat @click="close">Закрыть</v-btn>
                    <v-btn color="success" flat @click="register">Войти</v-btn>
                </v-card-actions>
            </form>
        </v-card>
    </v-dialog>
</template>

<script>
    import {register} from '../../helpers/auth';
    import {ErrorBag} from 'vee-validate';
    export default {
        name: "Registration",
        data() { return {
            name: null,
            email: null,
            password: null,
            r_password: null,
            terms: false,
            showed: false,
            dictionary: {
                custom: {
                    name: {
                        required: 'Никнейм не может быть пустым.',
                        max: 'Максимальная длина никнейма 30 символов.'
                    },
                    email: {
                        required: 'Email не может быть пустым.',
                        email: 'Поле не соответствует формату email.'
                    },
                    password: {
                        required: 'Пароль не может быть пустым.',
                        min: 'Минимальная длина пароля 8 символов.',
                        max: 'Максимальная длина пароля 50 символов.'
                    },
                    r_password: {
                        required: 'Поле должно соответствовать полю \'Пароль\'.',
                        confirmed: 'Поле должно соответствовать полю \'Пароль\'.'
                    },
                    terms: {
                        required: 'Согласие с правилами проекта обязательно для регистрации.'
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
                this.name = null;
                this.email = null;
                this.password = null;
                this.r_password = null;
                this.terms = null;
                this.$validator.reset();
            },
            open() {this.showed = true;},
            async register() {
                const credentials = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    r_password: this.r_password,
                    terms: this.terms
                };

                const res = await this.$validator.validateAll();

                if(res) {
                    register(credentials).then(res => {
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