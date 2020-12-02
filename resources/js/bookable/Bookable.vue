<template>

    <div class="row" v-if="!loading">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>{{ bookable.title }}</h2>
                    <hr>
                    <p>{{ bookable.description }}</p>
                </div>
            </div>
            <ReviewList></ReviewList>
        </div>
        <div class="col-md-4">
            <Availability @availability="checkPrice($event)" class="mb-3"></Availability>
            <transition name="fadeSlow">
                <PriceBreakdown v-if="price" :price="price"></PriceBreakdown>
            </transition>
            <transition name="fadeSlow">
                <button v-if="price"
                        :disabled="inBasketAlready"
                        class="btn btn-outline-secondary btn-block"
                        @click="addToBasket">
                    {{ !inBasketAlready ? 'Book now!' : 'Booked already!' }}
                </button>
            </transition>
            <transition name="fadeSlow">
                <button v-if="inBasketAlready"
                        class="btn btn-outline-secondary btn-block"
                        @click="removeFromBasket">
                    Remove from basket
                </button>
            </transition>
            <div v-if="inBasketAlready" class="mt-4 text-center rounded-lg border p-4 alert-warning">
                Looks like it is in Your basket already! You can not book it twice!
            </div>
        </div>


    </div>
    <div v-else>Data is loading...</div>
</template>

<script>
import Availability from "./Availability";
import ReviewList from "./ReviewList";
import PriceBreakdown from "./PriceBreakdown";
import {mapState} from "vuex";

export default {
    components: {
        Availability,
        ReviewList,
        PriceBreakdown,
    },
    data() {
        return {
            loading: false,
            bookable: null,
            price: null,


        }
    },


    created() {

        const bookableId = this.$route.params.id;
        this.loading = true;
        axios
            .get(`/api/bookables/${bookableId}`)
            .then(response => {
                this.bookable = response.data.data;
                this.loading = false;
            });
    },
    methods: {

        async checkPrice(hasAvailability) {
            if (!hasAvailability) {
                this.price = null;
                return;
            }
            try {
                const bookableId = this.$route.params.id;
                this.price = (await axios.get(
                    `/api/bookables/${bookableId}/price?from=${this.$store.state.lastSearch.from}&to=${this.$store.state.lastSearch.to}`)).data;

            } catch (err) {
                this.price = null;

            }
        },
        addToBasket() {
            this.$store.dispatch('addToBasket', {
                bookable: this.bookable,
                price: this.price,
                dates: this.lastSearch,
            });
        },
        removeFromBasket() {
            this.$store.dispatch("removeFromBasket", this.bookable.id)
        }
    },
    computed: {
        ...mapState({
            lastSearch: "lastSearch",

        }),
        inBasketAlready() {
            if (null === this.bookable) {
                return false;
            }
            return this.$store.getters.inBasketAlready(this.bookable.id);

        }
    },


}


</script>
<style scoped>

.fadeSlow-enter-active, .fadeSLow-leave-active {
    transition: opacity .9s;
}

.fadeSlow-enter, .fadeSlow-leave-to {
    opacity: 0;
}
</style>
