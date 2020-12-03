<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                CheckOutForm
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h6 class="text-secondary font-weight-bolder">Your cart</h6>
                    <h6 class="badge badge-secondary">
                        <span v-if="itemsInBasket">Items: {{ itemsInBasket }}</span>
                        <span v-else>Empty</span>
                    </h6>
                </div>
                <div v-for="item in basket" :key="item.bookable.id" class="p-2">
                    <div class="d-flex justify-content-between p-2 border-top">
                        <span><router-link :to="{name: 'bookable', params: {id: item.bookable.id}}">{{
                                item.bookable.title
                            }}</router-link> (${{ item.bookable.price }} per night)</span>
                        <span>${{ item.price.total }}</span>

                    </div>
                    <div class="d-flex justify-content-between p-2">
                        <span>From: {{ item.dates.from }}</span>
                        <span>To: {{ item.dates.to }}</span>

                    </div>
                    <div class="p-2 text-right">
                        <button
                            @click="$store.dispatch('removeFromBasket', item.bookable.id)"
                            class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from "vuex";

export default {
    name: "Basket",
    computed: {
        ...mapGetters(["itemsInBasket"]),
        ...mapState({
            basket: state => state.basket.items
        })
    }
}
</script>

<style scoped>
h6.badge {
    font-size: 100%;
}

a {
    color: black;
}
</style>
