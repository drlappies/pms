require('./bootstrap');
window.Vue = require('vue').default;
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import App from './components/App.vue'

const app = new Vue({
    el: '#app',
    components: {
        App
    }
});
