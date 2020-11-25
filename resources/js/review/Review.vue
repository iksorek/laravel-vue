<template>
    <div v-if="!loading">
  <FatalError v-if="error"></FatalError>

        <h3 class="text-center shadow rounded-pill mb-5">Review page</h3>
        <div class="row" v-if="!error">

            <div :class="[{'col-md-4': twoColumns},{'d-none': oneColumn}]">
                <div class="card rounded-lg">
                    <div class="card-body">
                        <div v-if="loading">Loading...</div>
                        <div v-if="!loading && booking !== null">
                            <p>Stayed at
                                <router-link :to="{name: 'bookable', params: {id: booking.bookable.id}}">
                                    {{ booking.bookable.title }}
                                </router-link>
                            </p>
                            <p>
                                From {{ booking.from }} to {{ booking.to }}
                            </p>

                        </div>
                    </div>
                </div>

            </div>
            <div :class="[{'col-md-8': twoColumns},{'col-md-12': oneColumn}]">


                <div v-if="alreadyReviewed" class="alert-danger text-center rounded">Booking has been already reviewed.</div>
                <div v-else>
                    <div class="form-group">
                        <label class="text-muted">Select the star rating 1 - 5 STARS</label>
                        <StarRating class="fa-3x" v-model="review.rating"></StarRating>
                    </div>
                    <div class="form-group">
                        <label for="content" class="text-muted">
                            Describe Your experience
                        </label>
                        <textarea
                                  id="content" cols="30" class="form-control" v-model="review.content">

                        </textarea>

                    </div>
                    <button @click.prevent="submit" :disabled="loading" class="btn btn-lg btn-primary btn-block">
                        Submit
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div v-else>
        Loading Data
    </div>
</template>

<script>
import {is404, is422} from "../shared/utils/response";

export default {
    name: "Review",
    data() {
        return {
            review: {
                id: null,
                rating: 5,
                content: null,


            },
            existingReview: null,
            loading: false,
            booking: null,
            error: false,
            errors: null,
        }

    },
    methods: {
        onRatingChange(rating) {
            this.review.rating = rating;
        },
        submit() {
            this.errors = null;
            this.loading = true;
            axios.post('/api/reviews', this.review)
                .then(response => console.log(response))
                .catch(err => {
                if(is422(err)){
                    const errors = err.response.data.errors;
                    if(errors['content'] && _.size(errors) === 1){
                        this.errors = errors;
                    }
                    return;
                }

              this.error = true;
                })
                .then(() => this.loading = false);
        },

    },
    created() {
        this.loading = true;
        this.review.id = this.$route.params.id;
        axios
            .get(`/api/reviews/${this.review.id}`)
            .then(response => {
                this.existingReview = response.data;
                this.loading = false;
            })
            .catch(err => {
                this.loading = false;

                if (is404(err)) {
                    return axios.get(`/api/booking-by-review/${this.review.id}`)
                        .then(response => {
                            this.booking = response.data;
                        })
                        .catch((err) => {
                            this.error = !is404(err);
                        });
                }
            })
            .then(() => {
                    this.loading = false;
                }
            );
    },
    computed: {
        alreadyReviewed() {
            return this.hasReview || !this.booking;
        },
        hasReview() {
            return this.existingReview !== null;
        },
        hasBooking() {
            return this.booking !== null;
        },
        oneColumn() {
            return !this.loading && this.alreadyReviewed;
        },
        twoColumns() {
            return this.loading || !this.alreadyReviewed;
        }

    },

}
</script>

<style scoped>

</style>
