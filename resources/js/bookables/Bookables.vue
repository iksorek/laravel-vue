<template>

    <div v-if="loading">Data is loading...</div>
    <div class="row d-flex justify-content-space" v-else>
        <BookableListItem
            v-for="bookable in bookables"
            :key="bookables.id"
            :bookable="bookable">
        </BookableListItem>
    </div>


</template>
<script>
import BookableListItem from "./BookableListItem";

export default {
    components: {
        BookableListItem,
    },
    data() {
        return {
            bookables: null,
            loading: false,
        }
    },
    created() {
        //////////////////PROMISE FOR REFERENCE
        // const p = new Promise((resolve, reject) => {
        //     console.log(resolve);
        //     console.log(reject);
        //     setTimeout(()=> resolve("Hello"), 3000);
        // }).then(result =>console.log(`Success ${result}`))
        // .catch(result => console.log(`Error ${result}`));
        // console.log(p);
        //

        this.loading = true;

        const request = axios.get("/api/bookables")
            .then(response => {
                this.bookables = response.data.data;
                this.loading = false;
            });

    }

}
</script>
<style>

</style>
