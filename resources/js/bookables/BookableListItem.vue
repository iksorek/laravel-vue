<template>
    <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
        <div class="card mt-3 w-100">

            <div class="card-text p-4">
                <router-link :to="{ name: 'bookable', params: { id: bookable.id }}">
                    <h5 class="card-title">{{ bookable.title }}</h5>
                </router-link>
                <p>{{ bookable.description | truncate(20) }}</p>
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
    filters: {
        truncate: function (value) {
            if (value && value.length > 20) {
                value = value.substring(0, 170) + '...';
            }
            return value
        }
    }


}
</script>
