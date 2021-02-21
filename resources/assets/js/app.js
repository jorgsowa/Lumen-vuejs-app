require('./bootstrap');

window.Vue = require('vue');

import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


Vue.config.devtools = true;
Vue.config.performance = true;

import App from './App.vue';

// var types = {
//     methods: {
//         Color: function ({id, name, hex}) {
//             this.id = id;
//             this.hex = hex;
//             this.name = name;
//         }
//     }
// };

const app = new Vue({
    // mixins: [Color],
    el: '#app',
    components: {
        App
    },
    render: h => h(App)
});
