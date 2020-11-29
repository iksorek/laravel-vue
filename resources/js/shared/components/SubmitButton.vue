<template>
    <button :disabled="loading" @click="check" class="btn btn-secondary btn-block mt-4">
        <span v-if="!loading"><slot></slot>!</span>
        <span v-if="loading"><i class="fas fa-circle-notch fa-spin"></i><slot></slot>ing...</span>
    </button>

</template>

<script>
export default {
    name: "SubmitButton",
    props: {
        loading: Boolean,
        check: Function,
    }
}
</script>

<style scoped>

</style>
