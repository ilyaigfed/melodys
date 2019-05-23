<template>
    <v-navigation-drawer
            mobile-break-point="1700"
            v-model="drawer"
            fixed
    >
        <v-toolbar flat class="transparent">
                    <v-list-tile-avatar>
                        <img src="/siteimages/logo.png">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
<!--                        <v-list-tile-title>Melodys</v-list-tile-title>-->
                    </v-list-tile-content>
            <v-list-tile-action>
                <v-btn icon @click.stop="close">
                    <v-icon>chevron_left</v-icon>
                </v-btn>
            </v-list-tile-action>
        </v-toolbar>

        <v-list class="pt-0" dense>
            <v-list-tile
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to"
            >
                    <v-list-tile-action>
                        <v-icon :color="item.color">{{ item.icon }}</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
            </v-list-tile>
            <template v-if="user">
                <v-divider></v-divider>
                <v-list-group prepend-icon="list" v-if="user">
                    <template v-slot:activator>
                        <v-list-tile>
                            <v-list-tile-title>{{ user.name }}</v-list-tile-title>
                        </v-list-tile>
                    </template>
                    <v-list-tile :to="`/profile/${user.link}`">
                        <v-list-tile-title>Профиль</v-list-tile-title>
                        <v-list-tile-action>
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-list-tile :to="{ name: 'settings' }">
                        <v-list-tile-title>Настройки</v-list-tile-title>
                        <v-list-tile-action>
                            <v-icon>settings</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-list-tile @click="logout">
                        <v-list-tile-title>Выход</v-list-tile-title>
                        <v-list-tile-action>
                            <v-icon>power_settings_new</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list-group>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    import Login from "./auth/Login";
    import Registration from "./auth/Registration";
    export default {
        name: "Nav",
        components: {Registration, Login},
        data() { return {
            items: [
                { title: 'Домой', icon: 'home', color: 'orange', to: '/' },
                { title: 'Подписки', icon: 'person_pin', color: 'orange', to: '/stream' }
            ]
        }},
        created() {
            if(window.innerWidth <= 1700) this.$store.commit('SET_NAV_DRAWER', false);
        },
        computed: {
            user() {
                return this.$store.getters.USER;
            },
            drawer: {
                get() {
                    return this.$store.getters.NAV_DRAWER;
                },
                set(value) {
                    this.$store.commit('SET_NAV_DRAWER', value);
                }
            }
        },
        methods: {
            push(to) {this.$router.push(to);},
            logout() {this.$store.dispatch('LOGOUT');},
            close() {this.$store.dispatch('CHANGE_NAV_DRAWER');},
            goToProfile() {this.$router.push(`/profile/${this.$store.getters.USER.link}`);}
        }
    }
</script>

<style scoped>

</style>