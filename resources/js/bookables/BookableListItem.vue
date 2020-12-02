<template>
    <div class="col-md-3 d-flex align-items-stretch">
        <div class="card mt-3 w-100">

            <div class="card-text p-4">
                <router-link :to="{ name: 'bookable', params: { id: bookable.id }}">
                    <h5 class="card-title">{{ bookable.title }}</h5>
                </router-link>
                <p>{{ bookable.description }}</p>
                <p v-if="bookable.price">$ {{ bookable.price }} per night</p>
                <p v-else>call for price</p>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    props: {
        'bookable': Object,
    },


}
</script>
