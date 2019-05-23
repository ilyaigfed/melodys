<template>
    <v-flex style="max-height: 48px;">
        <v-layout row>
            <v-flex xs9>
                <PublicationsNavigation></PublicationsNavigation>
            </v-flex>
            <v-flex xs3>
                <ProfileOptions></ProfileOptions>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
    import PublicationsNavigation from "./PublicationsNavigation";
    import ProfileOptions from "./ProfileOptions";
    export default {
        name: "PanelUnderProfile",
        components: {ProfileOptions, PublicationsNavigation}
    }
</script>

<style scoped>

</style>