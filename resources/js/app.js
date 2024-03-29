require('./bootstrap');
import router from "./routes";
import VueRouter from "vue-router";
import Vuex from "vuex";
import Index from "./Index";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import ValidationErrors from "./shared/components/ValidationErrors"
import Success from "./shared/components/Success";
import SubmitButton from "./shared/components/SubmitButton";
import storeDefinition from "./store";

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.component('StarRating', StarRating);
Vue.component('FatalError', FatalError);
Vue.component('v-errors', ValidationErrors);
Vue.component('success', Success);
Vue.component('submit-button', SubmitButton);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => response,
    error => {
        if (401 === error.response.status) {
            store.dispatch("logOut");
        }
        return Promise.reject(error);
    }
);
///////////////////INITIALIZATION////////////////////
const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        'index': Index,
    },
    async beforeCreate() {
        this.$store.dispatch('loadStoreState');
        this.$store.dispatch("loadUser");

    }
});
