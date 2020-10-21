import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/Index";
import Cart from "./views/Cart";

const routes = [
    {
        path: '/',
        component: Index
    },
    {
        path: '/cart',
        component: Cart
    },
];

export default new vueRouter({
    mode: "history",
    routes
})
