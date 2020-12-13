<template>

    <div class="w-50 m-auto">
        <div class="card card-body"><p class="font-weight-bolder text-center">Authorization required</p>
            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                           placeholder="Enter email"
                           v-model="email"
                           class="form-control"
                           :class="[{'is-invalid': errorFor('email')}]">
                    <v-errors :errors="errorFor('email')"></v-errors>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password"
                           v-model="password"
                           class="form-control"
                           :class="[{'is-invalid': errorFor('password')}]">
                    <v-errors :errors="errorFor('password')"></v-errors>

                </div>
                <button type="submit" :disabled="loding" @click.prevent="login"
                        class="btn-outline-primary btn btn-block">Login
                </button>
            </form>
            <hr>
            <span class="text-nowrap">
                No account?
                <router-link :to="{name: 'home'}" class="font-weight-bold">Register</router-link>
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

export default {
    name: "Login",
    mixins: [validationErrors],
    data() {
        return {
            email: null,
            password: null,
            loding: false,
        }
    },
    methods: {
        async login() {
            this.loding = true;
            this.errors = null;
            try {

                await axios.get('/sanctum/csrf-cookie');
                await axios.post("/login", {
                    email: this.email,
                    password: this.password
                });
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
                this.loding = false;
            }
            await axios.get('/user');


        }
    }
}
</script>

<style scoped>

</style>
