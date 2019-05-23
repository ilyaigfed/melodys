<template>
    <v-card
            style="user-select: none; cursor: pointer;"
            flat
    >
        <v-card-title primary-title class="pt-1 pb-1">
            <div>
                <span class="mb-0">{{ i+1 }}. {{ file.file.name }}</span>
            </div>
            <v-spacer></v-spacer>
            <div>
                <v-btn icon @click="cancel(i)">
                    <v-icon>close</v-icon>
                </v-btn>
                <v-btn icon @click="show = !show">
                    <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                </v-btn>
            </div>
        </v-card-title>
        <v-slide-y-transition>
            <v-card-text v-show="show">
                <v-flex xs4>
                    <v-text-field label="Название" v-model="file_title"></v-text-field>
                </v-flex>
            </v-card-text>
        </v-slide-y-transition>
    </v-card>
</template>

<script>
    export default {
        name: "FileListCard",
        props: ['file', 'i'],
        data() { return {
            show: false
        }},
        computed: {
            file_title: {
                get() {
                    return this.$store.state.files[this.i].title;
                },
                set(value) {
                    this.$store.commit('SET_FILE_PROP', {key: this.i, prop: 'title', data: value});
                }
            }
        },
        methods: {
            cancel(i) {
                this.$store.dispatch('CANCEL_FILE', i);
            }
        }
    }
</script>

<style scoped>

</style>