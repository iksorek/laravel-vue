<template>
    <div v-if="isLoggedIn">
        <div class="row">
            <div class="col-md-3">
                My Account menu<br>
                My Account menu<br>
                My Account menu<br>
                My Account menu<br>
                My Account menu
            </div>
            <div class="col-md-9">
                Srodek
            </div>

        </div>
    </div>
    <div v-else>
        You are not authorized. Please
        <router-link :to="{name: 'Login'}">LOG IN</router-link>
    </div>


</template>

<script>
import {mapState} from "vuex";
import DefaultLoggedIn from "./DefaultLoggedIn";

export default {
    name: "MyAccount",
    components: {DefaultLoggedIn},
    computed: {

        ...mapState({
            isLoggedIn: "isLoggedIn",
        }),
    }
}

</script>

<style scoped>

</style>
