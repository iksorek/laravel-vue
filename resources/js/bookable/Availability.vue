<template>
    <div class="bg-white p-2 border mt-1">
        <h6 class="text-secondary font-weight-bolder">
            Check Availability
            <transition>
                <p v-if="noAvailability" class="text-danger">No availability in selected dates</p>
                <p v-if="hasAvailability" class="text-success">Selected dates are available</p>
            </transition>
        </h6>

        <div class="form-row">
            <div class="from-group col-md-6">
                <label for="from">From</label>
                <input type="date" name="from" id="from"
                       v-model="from"
                       @keyup.enter="check"
                       class="form-control
               form-control-sm" placeholder="Start date"
                       :class="[{'is-invalid': this.errorFor('from')}]">
                <transition>
                    <v-errors v-if="errorFor('from')" :errors="errorFor('from')"></v-errors>
                </transition>

            </div>

            <div class="from-group col-md-6">
                <label for="to">To</label>
                <input type="date" name="to" id="to" class="form-control
               form-control-sm"
                       v-model="to"
                       @keyup.enter="check"
                       placeholder="End date"
                       :class="[{'is-invalid': this.errorFor('to')}]">
                <transition>
                    <v-errors v-if="errorFor('to')" :errors="errorFor('to')"></v-errors>
                </transition>
            </div>

        </div>
        <submit-button :loading="loading" :check="check">Check</submit-button>

    </div>

</template>

<script>
import {is422, is404} from "../shared/utils/response";
import validationErrors from "../shared/mixins/validationErrors";

export default {
    mixins: [validationErrors],
    data() {
        return {
            from: this.$store.state.lastSearch.from,
            to: this.$store.state.lastSearch.to,
            loading: false,
            status: null,

        }
    },
    methods: {
        check() {
            this.$store.commit('setLastSearch', {
                from: this.from,
                to: this.to
            });
            this.loading = true;
            this.errors = null,
                axios.get(`/api/bookables/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`)
                    .then(response => {
                        this.status = response.status;
                        this.loading = false;
                    })
                    .catch(error => {
                        if (is422(error)) {
                            this.errors = error.response.data.errors;
                        }
                        this.status = error.response.status;
                        this.loading = false;
                    });


        },

    },
    computed: {
        hasErrors() {
            return 422 === this.status && this.errors !== null;
        },
        hasAvailability() {
            return 200 === this.status;
        },
        noAvailability() {
            return 404 === this.status;
        }
    }

}

</script>

<style scoped>
label {
    font-size: 0.7rem;
    text-transform: uppercase;
    font-weight: bolder;
}

.border {
    border-radius: 5px;
}

.is-invalid {
    border-color: #d24013;
    background-image: none;
}

.invalid-feedback {
    display: block;
}
</style>
