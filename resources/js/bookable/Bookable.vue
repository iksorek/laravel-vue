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
                <button v-if="price" class="btn btn-outline-secondary btn-block">Book now!</button>
            </transition>
        </div>


    </div>
    <div v-else>Data is loading...</div>
</template>

<script>
import Availability from "./Availability";
import ReviewList from "./ReviewList";

export default {
    components: {
        Availability,
        ReviewList,
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
        }
    }
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
