
require('./bootstrap');

import router from "./routes";
import VueRouter from "vue-router";
import Index from "./Index";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import ValidationErrors from "./shared/components/ValidationErrors"
import Success from "./shared/components/Success";

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.component('StarRating', StarRating);
Vue.component('FatalError', FatalError);
Vue.component('v-errors', ValidationErrors);
Vue.component('success', Success);

///////////////////INITIALIZATION////////////////////
const app = new Vue({
    el: '#app',
    router,
    components: {
        'index': Index,
    }
});
