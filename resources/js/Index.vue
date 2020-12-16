<template>
    <div>
        <nav class="navbar navbar-expand-lg px-5 bg-light border-bottom navbar-light d-flex justify-content-between">
            <router-link class="navbar-brand" :to="{name: 'home'}">MyBNB</router-link>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'Basket'}">
                        Basket
                        <span v-if="itemsInBasket" class="badge bg-secondary">{{ itemsInBasket }}</span>
                    </router-link>

                </li>
                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link :to="{name: 'Register'}" class="nav-link">
                        Register
                    </router-link>
                </li>
                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link :to="{name: 'Login'}" class="nav-link">
                        Sign in
                    </router-link>
                </li>
                <li class="nav-item" v-if="isLoggedIn">
                    <router-link :to="{name: 'myProfile'}" class="nav-link">
                        My Account
                    </router-link>
                </li>
                <li class="nav-item" v-if="isLoggedIn">
                    <a class="nav-link" @click.prevent="logout">
                        Logout
                    </a>
                </li>


            </ul>
        </nav>
        <div class="container mx-auto p-4">
            <router-view/>
        </div>

    </div>
</template>

<script>

import {mapState, mapGetters} from "vuex";

export default {


    computed: {

        ...mapState({
            lastSearchComputed: "lastSearch",
            isLoggedIn: "isLoggedIn",
        }),
        ...mapGetters({
            itemsInBasket: 'itemsInBasket',
        }),
    },
    methods: {
        async logout() {
            try {
                axios.get("/logout");
                this.$store.dispatch("logOut");
            } catch (err) {
                this.$store.dispatch("logOut");
            }
        }
    }
}
</script>
<style scoped>

</style>
