import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue';
import axios from 'axios';

Vue.use(VueRouter);

import {router} from "./router/router";

const apiConfigs = axios.create({
    baseURL: 'http://test-team-player.loc/api/'
});

Vue.prototype.$http = apiConfigs;

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
