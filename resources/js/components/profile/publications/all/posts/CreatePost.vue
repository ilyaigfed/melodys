<template>
    <v-flex xs12 class="pl-3">
        <v-textarea
                v-model="text"
                label="Хотите что-нибудь написать?"
                @keypress.enter="send"
                color="orange"
        ></v-textarea>
        <v-layout row justify-end>
            <v-btn color="warning" small @click="send">
                Написать
            </v-btn>
        </v-layout>
    </v-flex>
</template>

<script>
    export default {
        name: "CreatePost",
        data() { return {
            text: null
        }},
        methods: {
            send() {
                let form_data = new FormData();

                if(this.text) {
                    form_data.set('text', this.text);
                }

                this.$store.dispatch('CREATE_PROFILE_POST', { data: form_data, link: this.$route.params.link });
                this.text = null;
            }
        }
    }
</script>

<style scoped>

</style>