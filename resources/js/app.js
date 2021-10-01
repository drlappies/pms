import Vue from 'vue';
import './bootstrap';
import router from './components/routes/router'

Vue.component('app', require('./components/App.vue').default)

const app = new Vue({
    el: '#app',
    router
});
