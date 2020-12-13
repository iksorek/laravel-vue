<template>
    <div class="m-3">
        <h6 class="text-secondary font-weight-bolder text-center">Price breakdown</h6>
        <div class="pt-2 pb-2" v-for="(days, price) in price.data.breakdown" :key="price">
            {{ days }} x ${{ price }}
        </div>

        <div class="font-weight-bolder d-flex justify-content-between">
            <span>Total:</span>
            <span>${{ price.data.total }}</span>


        </div>
    </div>
</template>

<script>
export default {
    name: "PriceBreakdown",
    props: {
        price: Object,
    }
}
</script>

<style scoped>

</style>

