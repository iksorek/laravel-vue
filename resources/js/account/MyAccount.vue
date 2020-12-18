<template>
    <div v-if="isLoggedIn">
        <div class="row">
            <div class="col-md-3">
                <div class="flex-column">
                    <router-link :to="{name: 'myProfile'}" class="nav-link">Profile</router-link>
                    <router-link :to="{name: 'myBookings'}" class="nav-link">My Bookings</router-link>
                    <router-link :to="{name: 'LeaveReview'}" class="nav-link">Leave a review</router-link>

                </div>
            </div>
            <div class="col-md-9">
                <router-view/>
            </div>

        </div>
    </div>
    <div v-else>
        You are not authorized. Please
        <router-link :to="{name: 'Login'}">LOG IN</router-link>
    </div>


</template>

<script>
import {mapState} from "vuex";
import DefaultLoggedIn from "./DefaultLoggedIn";

export default {
    name: "MyAccount",
    components: {DefaultLoggedIn},
    computed: {

        ...mapState({
            isLoggedIn: "isLoggedIn",
        }),
    }
}

</script>

<style scoped>
.nav-link {
    text-transform: uppercase;
    color: #1a202c;
    transition: .2s;

}

.nav-link:hover {
    color: #2d3748;
    text-shadow: 2px 2px 10px black;
    margin-left: 3px;
    font-weight: bold;
}

</style>
