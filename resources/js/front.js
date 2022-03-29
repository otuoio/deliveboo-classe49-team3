require('./bootstrap');

window.Vue = require('vue');
import App from './views/App.vue';
import Home from './pages/Home';
import Restaurant from './pages/Restaurant';

import VueRouter from 'vue-router';
import Vue from 'vue';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/:id',
            name: 'restaurant',
            component: Restaurant
        }
    ]
})

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
