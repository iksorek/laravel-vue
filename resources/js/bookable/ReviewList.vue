<template>
    <div class="mt-3 shadow border p-3">

        <h6 class="mb-4 font-weight-bolder text-uppercase">Review List</h6>

        <div v-if="loading">Loading Data...</div>
        <div class="border-bottom m-3" v-else v-for="(review, index) in reviews" :key="index">
            <div class="row">
                <div class="col-md-6">
                    John Doe
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <StarRating :value="review.rating"></StarRating>


                </div>
            </div>
            <div class="row">
                <div class="col-12">{{ review.created_at }}</div>
            </div>
            <div class="row">
                <div class="col-12 p-4">
                    {{ review.content }}
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "ReviewList",
    data() {
        return {
            loading: false,
            reviews: null,


        }

    },
    created() {
        const bookableId = this.$route.params.id;
        this.loading = true;
        axios
            .get(`/api/bookables/${bookableId}/reviews`)
        .then(response =>{
            this.reviews = response.data;
            this.loading = false;
        })



    }


}


</script>

<style scoped>

</style>
