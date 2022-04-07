require('./bootstrap');

window.Vue = require('vue');
import App from './views/App.vue';
import Home from './pages/Home';
import Restaurant from './pages/Restaurant';
import Checkout from './pages/Checkout';

import VueRouter from 'vue-router';
import Vue from 'vue';
Vue.use(VueRouter);


import vueBraintree from 'vue-braintree';
Vue.use(vueBraintree)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            props: true,
            component: Home
        },
        {
            path: '/restaurants/:slug',
            name: 'restaurant',
            component: Restaurant,
            props: true,
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
        }
    ]
})

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
