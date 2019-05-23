<template>
    <v-toolbar
            app
            clipped-left
            fixed
            v-resize="onResize"
    >
                <v-toolbar-side-icon @click="changeNav" v-if="show"></v-toolbar-side-icon>
                <v-avatar class="ml-2">
                    <img
                            src="/siteimages/logo.png"
                            alt="John"
                    >
                </v-avatar>
                <v-toolbar-title>
                    Melodys
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-flex xs2 class="mr-3">
                    <v-text-field
                            hide-details
                            prepend-icon="search"
                            solo
                            color="orange"
                    ></v-text-field>
                </v-flex>
                <v-toolbar-items class="hidden-sm-and-down">
                    <template v-if="!user">
                        <Login></Login>
                        <Registration></Registration>
                    </template>
                    <template v-else>
                        <v-btn flat @click="$router.push('/upload')">Загрузить</v-btn>
                    </template>
                </v-toolbar-items>
                <template v-if="user">
                    <v-chip class="ml-3" @click="goToProfile(user.link)">
                        <v-avatar>
                            <img :src="user.image ? '/storage/'+user.image: '/storage/common/none-avatar.jpg'">
                        </v-avatar>
                        {{ user.name }}
                    </v-chip>
                </template>

    </v-toolbar>
</template>

<script>
    import Login from "./auth/Login";
    import Registration from "./auth/Registration";
    export default {
        name: "Toolbar",
        components: {Registration, Login},
        data() { return {
            show: false,
            items: [
                { title: 'Профиль' }
            ]
        }},
        created() {
            if(window.innerWidth <= 1700) this.show = true;
        },
        watch: {
            user() {
                
            }
        },
        computed: {
            user() {
                return this.$store.getters.USER;
            }
        },
        methods: {
            changeNav() {
                this.$store.dispatch('CHANGE_NAV_DRAWER');
            },
            onResize() {
                if(window.innerWidth <= 1700) {
                    this.show = true;
                } else {
                    this.show = false;
                }
            },
            goToProfile(link) {this.$router.push(`/profile/${link}`);}
        }
    }
</script>

<style scoped>
    .upload-bar {
        position: absolute;
        top: 50px;
        left: 0;
        z-index: 1;
    }
</style>