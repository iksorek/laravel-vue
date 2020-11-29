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
            <Availability @availability="checkPrice($event)"></Availability>
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
        checkPrice(hasAvailability){
            console.log(hasAvailability);
        }
    }
}


</script>
