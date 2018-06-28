
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'

import App from './App.vue'
import router from './router'
// LightBootstrap plugin
import LightBootstrap from './light-bootstrap-main'



// beforeEach route scroll to top
router.beforeEach( (to, from, next) => {
    window.scrollTo(0,0);
    next(true);
});


Vue.use(LightBootstrap)

const app = new Vue({
	el: '#root',
	template: `<app></app>`,
	components: { App },
	router,
    data: {
        auth: Laravel.Auth,
        channel : Laravel.Channel
    }
})


