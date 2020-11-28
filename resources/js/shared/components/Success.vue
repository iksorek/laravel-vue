<template>
    <div class="text-center alert-warning rounded-lg p-3">
        <i class="far fa-thumbs-up"></i>
        <h2>Success!</h2>
        <p>
            <slot></slot>
        </p>
    </div>
</template>

<script>
export default {
    name: "Success"
}
</script>

<style scoped>
.success {

}
.fa-thumbs-up {
    font-size: 10rem;
}
</style>
