<template>
    <div>
        <nav class="navbar bg-light border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">MyBNB</router-link>
            <router-link class="btn nav-button" :to="{name: 'Basket'}">
                Basket
                <span v-if="itemsInBasket" class="badge badge-secondary">{{ itemsInBasket }}</span>
            </router-link>

        </nav>
        <div class="container m-4 p-4">
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
        }),
        ...mapGetters({
            itemsInBasket: 'itemsInBasket',
        }),
    }
}
</script>
