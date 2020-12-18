<template>
    <div>
        <h2>Leave a review</h2>
        <div v-if="reviews">
            <h3>You have unrated bookings:</h3>
            <div v-for="stay in reviews" :key="reviews.id" class="d-flex justify-content-between">
                <span>Booking in: {{ stay.bookable.title }} from {{ stay.from }} to {{ stay.to }}</span>
                <span><router-link
                    :to="{name: 'Review', params: {id: stay.review_key}}">LEAVE A REVIEW</router-link></span>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    name: "LeaveReview",
    data() {
        return {
            loading: false,
            reviews: null,
            error: null,
            cookie: null,
        }
    },
    methods: {
        getUnreviewedBookings() {


            axios.get('/sanctum/csrf-cookie');
            axios.get("/my/reviews")
                .then(response => {
                    this.reviews = response.data;
                }).catch(err => {
                this.error = err;
            });


        }


    },
    created() {
        this.getUnreviewedBookings();
    }
}
</script>

<style scoped>

</style>
