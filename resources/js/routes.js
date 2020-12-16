import ExampleComponent from "./components/ExampleComponent";
import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";
import Review from "./review/Review";
import Basket from "./basket/Basket";
import Login from "./auth/Login";
import Register from "./auth/Register";
import MyAccount from "./account/MyAccount";




const routes = [
    {
        path: "/",
        component: Bookables,
        name: 'home',
    },
    {
        path: "/bookable/:id",
        component: Bookable,
        name: 'bookable',
    },
    {
        path: "/review/:id",
        component: Review,
        name: 'Review',
    },
    {
        path: "/basket",
        component: Basket,
        name: 'Basket',
    },
    {
        path: "/auth/login",
        component: Login,
        name: 'Login',
    },
    {
        path: "/auth/register",
        component: Register,
        name: 'Register',
    },

    {
        path: "/my-account",
        component: MyAccount,
        name: 'my_account',
    },

];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;
