<template>
    <div class="text-center alert-warning rounded-lg p-3">
        <i class="fas fa-bomb"></i>
        <h2>We have encountered a problem</h2>
        <p>Unfortunately we can not proceed.</p>
    </div>
</template>

<script>
export default {
    name: "FatalError"
}
</script>

<style scoped>
.fa-bomb{
    font-size: 10rem;
    color: black;
}
</style>
