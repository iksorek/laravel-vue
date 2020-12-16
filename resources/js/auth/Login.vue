<template>

    <div class="w-50 m-auto">
        <div class="card card-body"><p class="font-weight-bolder text-center">Authorization required</p>
            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                           placeholder="Enter email"
                           v-model="email"
                           :class="[{'is-invalid': errorFor('email')}]"
                           class="form-control">
                    <v-errors :errors="errorFor('email')"></v-errors>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password"
                           v-model="password"
                           :class="[{'is-invalid': errorFor('password')}]"
                           class="form-control"
                    >
                    <v-errors :errors="errorFor('password')"></v-errors>

                </div>
                <button type="submit" :disabled="loading" @click.prevent="login"
                        class="btn-outline-primary btn btn-block">Login
                </button>
            </form>
            <hr>
            <span class="text-nowrap">
                No account?
                <router-link :to="{name: 'Register'}" class="font-weight-bold">Register</router-link>
            </span>
            <span class="text-nowrap">
                Forgotten password?
                <router-link :to="{name: 'home'}" class="font-weight-bold">Reset password</router-link>
            </span>
        </div>

    </div>

</template>

<script>
import validationErrors from "../shared/mixins/validationErrors";

import {logIn, logOut, isLoggedIn} from "../shared/utils/auth";

export default {
    name: "Login",
    mixins: [validationErrors],
    data() {
        return {
            email: null,
            password: null,
            loading: false,
        }
    },
    methods: {
        async login() {
            this.loading = true;
            this.errors = null;
            try {

                await axios.get('/sanctum/csrf-cookie');
                await axios.post("/login", {
                    email: this.email,
                    password: this.password
                });
                logIn();
                await this.$store.dispatch("loadUser");
                await this.$router.push({name: "home"});
                this.loading = false;
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
