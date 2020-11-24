<template>

    <div v-if="loading">Data is loading...</div>
    <div class="row d-flex justify-content-center" v-else>
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


        // setTimeout(() => {
        //     this.bookables = [{
        //         id: 1,
        //         title: 'Cheap Villa2',
        //         content: 'Cheap Villa2 description',
        //         price: Math.floor(Math.random() * 100),
        //     },
        //         {
        //             id: 2,
        //             title: 'Cheap Villa22',
        //             content: 'Cheap Villaesd2 description',
        //             price: Math.floor(Math.random() * 100),
        //         },
        //         {
        //             id: 24,
        //             title: 'Cheap Villa22',
        //             content: 'Cheap Villaesd2 description',
        //             price: Math.floor(Math.random() * 100),
        //         },
        //         {
        //             id: 23,
        //             title: 'Cheap Villa22',
        //             content: 'Cheap Villaesd2 description',
        //             price: Math.floor(Math.random() * 100),
        //         }];
        //     this.loading = false;
        // }, 2000);
    }

}
</script>
<style>

</style>
