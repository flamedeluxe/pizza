import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/Index";
import Cart from "./views/Cart";
import Done from "./views/Done";
import PageNotFound from  "./views/PageNotFound";
import Register from "./views/Register";
import Login from "./views/Login";
import Orders from "./views/Orders";

const routes = [
    {
        path: '/',
        component: Index,
        meta: {
            title: 'Catalog'
        }
    },
    {
        path: '/cart',
        component: Cart,
        meta: {
            title: 'Cart'
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            title: 'Login'
        }
    },
    {
        path: '/register',
        component: Register,
        meta: {
            title: 'Register'
        }
    },
    {
        path: '/done',
        component: Done,
        meta: {
            title: 'Done'
        }
    },
    {
        path: '/my-orders',
        component: Orders,
        beforeEnter: (to, from, next) => {
            if(!localStorage.getItem('token')) {
                next({ name: 'login' })
            }else {
                next()
            }
        },
        meta: {
            title: 'My orders'
        }
    },
    {
        path: "*",
        component: PageNotFound,
        meta: {
            title: '404',
            robots: "no-follow"
        }
    },
];

export default new vueRouter({
    mode: "history",
    routes
})
