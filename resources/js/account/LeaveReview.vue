<template>
    <h2>Leave a review</h2>
</template>

<script>
export default {
    name: "LeaveReview",
    data() {
        return {
            loading: false,
            reviews: null,
            error: null,
        }
    },
    methods: {
        getUnreviewedBookings() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    this.reviews = (axios.get('/api/my/reviews')).data;
                })
                .catch(err => this.error)
        }
    },
    created() {
        this.getUnreviewedBookings();
    }
}
</script>

<style scoped>

</style>
