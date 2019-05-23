<template>
    <v-layout justify-center>
        <v-flex xs8>
            <v-card
                    class="text-xs-center pa-5"
                    flat
            >
                <v-card-text>
                    <span class="display-4">404</span>
                    <v-spacer></v-spacer>
                    <span class="headline">Такой страницы у нас нет</span>
                </v-card-text>
                <v-card-text>
                    <span>Кажется, Вы допустили опечатку, набирая адрес или воспользовались неисправной ссылкой.</span>
                </v-card-text>
                <v-btn flat color="info" :to="{ name: 'home' }">На главную</v-btn>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "NotFound"
    }
</script>

<style scoped>

</style>