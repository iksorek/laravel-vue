<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8" v-if="!itemsInBasket">
                <p class="text-center alert-info">There is no bookings in Your basket yet.</p>
            </div>
            <div class="col-md-8" v-if="itemsInBasket">
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="first_name">First names</label>
                        <input type="text"
                               :class="[{'is-invalid': this.errorFor('customer.first_names')}]"
                               v-model="customer.first_names" id="first_name" class="form-control">
                        <v-errors :errors="errorFor('customer.first_names')"></v-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Last name</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.last_name')}]"
                            type="text" v-model="customer.last_name" id="last_name" class="form-control">
                        <v-errors :errors="errorFor('customer.last_name')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="email">E-mail address</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.email')}]"
                            type="text" id="email" v-model="customer.email" class="form-control">
                        <v-errors :errors="errorFor('customer.email')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="street">Street and number</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.street')}]"
                            type="text" id="street" v-model="customer.street" class="form-control">
                        <v-errors :errors="errorFor('customer.street')"></v-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.city')}]"
                            type="text" v-model="customer.city" id="city" class="form-control">
                        <v-errors :errors="errorFor('customer.city')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="country">Country</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.country')}]"
                            type="text" v-model="customer.country" id="country" class="form-control">
                        <v-errors :errors="errorFor('customer.country')"></v-errors>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="state">State</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.state')}]"
                            type="text" v-model="customer.state" id="state" class="form-control">
                        <v-errors :errors="errorFor('customer.state')"></v-errors>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zip_code">Zip code</label>
                        <input
                            :class="[{'is-invalid': this.errorFor('customer.zip')}]"
                            type="text" v-model="customer.zip" id="zip_code" class="form-control">
                        <v-errors :errors="errorFor('customer.zip')"></v-errors>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button type="submit"
                                @click.prevent="book"
                                :disabled="this.loading"
                                class="btn btn-block btn-lg btn-primary">
                            Book now!
                        </button>

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
                            <span>${{ item.price.data.total }}</span>

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
import validationErrors from "../shared/mixins/validationErrors";

export default {
    name: "Basket",
    mixins: [validationErrors],

    data() {
        return {
            customer: {
                first_names: null,
                last_name: null,
                email: null,
                street: null,
                city: null,
                country: null,
                state: null,
                zip: null

            },
            loading: false,


        }
    },
    computed: {
        ...mapGetters(["itemsInBasket"]),
        ...mapState({
            basket: state => state.basket.items
        })
    },
    methods: {
        async book() {
            this.errors = null;
            this.loading = true;
            try {
                await axios.post("/api/checkout", {
                    bookings: this.basket.map(basketItem => ({
                        bookable_id: basketItem.bookable.id,
                        from: basketItem.dates.from,
                        to: basketItem.dates.to,

                    })),
                    customer: this.customer,

                });
                this.$store.dispatch("clearBasket");
            } catch (error) {
                this.errors = error.response && error.response.data.errors;

            }


            this.loading = false;

        },
    },
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
