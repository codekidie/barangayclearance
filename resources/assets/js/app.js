
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('blotter', require('./components/Blotter.vue'));
Vue.component('socialPension', require('./components/SocialPension.vue'));
Vue.component('prerequisite', require('./components/Prerequisite.vue'));
Vue.component('schedule', require('./components/Schedule.vue'));
Vue.component('messages', require('./components/Messages.vue'));
Vue.component('location', require('./components/Location.vue'));
Vue.component('details', require('./components/Details.vue'));
Vue.component('certificate', require('./components/Certificate.vue'));

const app = new Vue({
    el: '#app'
});
