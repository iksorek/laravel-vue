<template>
    <div class="bg-white p-2 border mt-1">
        <h6 class="text-secondary font-weight-bolder">
            Check Availability
            <p v-if="noAvailability" class="text-danger">No availability in selected dates</p>
            <p v-if="hasAvailability" class="text-success">Selected dates are available</p>
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
                <v-errors :errors="errorFor('from')"></v-errors>
            </div>

            <div class="from-group col-md-6">
                <label for="to">To</label>
                <input type="date" name="to" id="to" class="form-control
               form-control-sm"
                       v-model="to"
                       @keyup.enter="check"
                       placeholder="End date"
                       :class="[{'is-invalid': this.errorFor('to')}]">

                <v-errors :errors="errorFor('to')"></v-errors>
            </div>

        </div>
        <button @click="check" :disabled="loading" class="btn btn-secondary btn-block mt-4">Check</button>
    </div>

</template>


<script>
import {is422, is404} from "../shared/utils/response";
import validationErrors from "../shared/mixins/validationErrors";

export default {
    mixins: [validationErrors],
    data() {
        return {
            from: null,
            to: null,
            loading: false,
            status: null,

        }
    },
    methods: {
        check() {
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
