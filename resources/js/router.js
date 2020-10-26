import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/Index";
import Cart from "./views/Cart";
import PageNotFound from  "./views/PageNotFound";
import Register from "./views/Register";
import Login from "./views/Login";

const routes = [
    {
        path: '/',
        component: Index
    },
    {
        path: '/cart',
        component: Cart
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: "*",
        component: PageNotFound,
        meta: {
            robots: "no-follow"
        }
    },
];

export default new vueRouter({
    mode: "history",
    routes
})
