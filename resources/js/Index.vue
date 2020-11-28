<template>
<div>
    <nav class="navbar bg-light border-bottom navbar-light">
        <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">MyBNB</router-link>

</nav>
<div class="container m-4 p-4">
    <router-view/>
</div>

</div>
</template>

<script>
import ExampleComponent from "./components/ExampleComponent";
export default {
 components: {
     ExampleComponent,
 }
}
</script>
