<template>
    <v-app>
        <Nav></Nav>
        <Toolbar></Toolbar>
        <v-content class="pt-3">
            <v-container fluid class="pa-0" fill-height>
                <router-view></router-view>
            </v-container>
        </v-content>
        <Player></Player>
    </v-app>
</template>

<script>
    import Nav from "./Nav";
    import Login from "./auth/Login";

    import Toolbar from "./Toolbar";
    import Player from "./Player";
    export default {
        name: "App",
        components: {Player, Toolbar, Nav}
    }
</script>

<style scoped>

</style>