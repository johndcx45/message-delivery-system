require('./bootstrap');

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import { routes } from './routes.js';
import Vue from 'vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);


const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});