<template>
    <div class="d-flex">
        <i class="fas fa-star" v-for="star in value"
           :key="'st' + star" @click="$emit('input', star)"></i>
        <i class="far fa-star" v-for="empty in emptyStars"
           :key="'em' + empty" @click="$emit('input', value + empty)"></i>
    </div>
</template>

<script>
export default {
    name: "StarRating",
    props: {
        value: Number,
    },
    computed: {
        emptyStars() {
            return 5 - this.value;
        }
    },
    created() {

    }
}
</script>

<style scoped>

</style>
