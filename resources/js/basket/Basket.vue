<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="first_name">First names</label>
                        <input type="text" id="first_name" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" id="last_name" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="email">E-mail address</label>
                        <input type="text" id="email" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="street">Street and number</label>
                        <input type="text" id="street" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="state">State</label>
                        <input type="text" id="state" class="form-control">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zip_code">Zip code</label>
                        <input type="text" id="zip_code" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Book now!</button>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h6 class="text-secondary font-weight-bolder">Your cart</h6>
                    <h6 class="badge badge-secondary">
                        <span v-if="itemsInBasket">Items: {{ itemsInBasket }}</span>
                        <span v-else>Empty</span>
                    </h6>
                </div>

                <transition-group name="fade">
                    <div v-for="item in basket" :key="item.bookable.id" class="p-2">
                        <div class="d-flex justify-content-between p-2 border-top">
                        <span><router-link :to="{name: 'bookable', params: {id: item.bookable.id}}">{{
                                item.bookable.title
                            }}</router-link><br> (${{ item.bookable.price }} per night)</span>
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
                </transition-group>
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
