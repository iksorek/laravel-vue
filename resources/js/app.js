require('./bootstrap');

import router from "./routes";
import VueRouter from "vue-router";
import Index from "./Index";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
window.Vue = require('vue');
Vue.use(VueRouter);
Vue.component('StarRating', StarRating);
Vue.component('FatalError', FatalError);




const app = new Vue({
    el: '#app',
    router,
    components: {
        'index': Index,
    }
});