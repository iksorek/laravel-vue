<template>

    <div class="w-50 m-auto">
        <div class="card card-body"><p class="font-weight-bolder text-center">Registration</p>
            <form>
                <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" id="name" name="name"
                           placeholder="Enter Your name"
                           v-model="user.name"
                           :class="[{'is-invalid': errorFor('name')}]"
                           class="form-control">
                    <v-errors :errors="errorFor('name')"></v-errors>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                           placeholder="Enter email"
                           v-model="user.email"
                           :class="[{'is-invalid': errorFor('email')}]"
                           class="form-control">
                    <v-errors :errors="errorFor('email')"></v-errors>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password"
                           v-model="user.password"
                           :class="[{'is-invalid': errorFor('password')}]"
                           class="form-control"
                    >
                    <v-errors :errors="errorFor('password')"></v-errors>

                </div>
                <div class="form-group">
                    <label for="password_confirmation">Re-type Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm Your password"
                           v-model="user.password_confirmation"
                           :class="[{'is-invalid': errorFor('password_confirmation')}]"
                           class="form-control"
                    >
                    <v-errors :errors="errorFor('password_confirmation')"></v-errors>

                </div>
                <button type="submit" :disabled="loading" @click.prevent="register"
                        class="btn-outline-primary btn btn-block">Register
                </button>
            </form>

        </div>

    </div>

</template>

<script>
import validationErrors from "../shared/mixins/validationErrors";

import {logIn} from "../shared/utils/auth"

export default {
    name: "Register",
    mixins: [validationErrors],
    data() {
        return {
            user: {
                email: null,
                password: null,
                password_confirmation: null,
                name: null,
            },

            loading: false,
        }
    },
    methods: {
        async register() {
            this.loading = true;
            this.errors = null;
            try {

                const response = await axios.post('/register', this.user);
                if (response.status === 201) {
                    logIn();
                    await this.$store.dispatch("loadUser");
                    await this.$router.push({name: "home"});
                    this.loading = false;
                }


            } catch (error) {
                this.errors = error.response && error.response.data.errors;
                this.loading = false;
            }
            //await axios.get('/user');
            this.loading = false;


        }
    }
}
</script>

<style scoped>

</style>
