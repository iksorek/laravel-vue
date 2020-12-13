<template>

    <div class="w-50 m-auto">
        <div class="card card-body"><p class="font-weight-bolder text-center">Authorization required</p>
            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                           placeholder="Enter email"
                           v-model="email"
                           class="form-control">

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password"
                           v-model="password"
                           class="form-control">

                </div>
                <button type="submit" class="btn-outline-primary btn btn-block">Login</button>
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
export default {
    name: "Login",
    data() {
        return {
            email: null,
            password: null,
        }
    }
}
</script>

<style scoped>

</style>
