require('./bootstrap');

import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import store from './src/store'
import VueRouter from 'vue-router'
import Index from './index'
import auth from './src/resources/auth'
import router from './src/resources/router'
import Vuex from 'vuex';

window.Vue = Vue

Vue.router = router

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)
Vue.use(Vuex);

axios.defaults.baseURL = "/api/"

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('index', Index)
const app = new Vue({
    el: '#app',
    router,
    store
});
