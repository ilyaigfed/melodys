import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import {routes} from './routes';
import storeData from './store';
import App from './components/App';

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VeeValidate);

Vue.filter('numbers', (value) => {
    let number = value + 1;
    if (number < 10) {
        return "0" + number + ".";
    }
    return number + ".";
});

Vue.filter('minutes', (value) => {
    if (!value || typeof value !== "number") return "00:00";
    let min = parseInt(value / 60),
        sec = parseInt(value % 60);
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;
    value = min + ":" + sec;
    return value;
});

const store = new Vuex.Store(storeData);

const router = new VueRouter({
    routes,
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requires_auth)) {
        if (!store.getters.USER) {
            next({ name: 'not-found' });
        } else {
            next();
        }
    } else {
        next();
    }
});

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});

export {router, store};