import VueRouter from 'vue-router'

import Home from '../components/Home'
import Register from '../components/auth/Register'
import Login from '../components/auth/Login1'
import Dashboard from '../components/user/Dashboard'
import Products from "../components/product/Products";
import Category from "../components/category/Category";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: '/products',
        name: 'products',
        component: Products,
        meta: {
            auth: true
        }
    },

    {
        path: '/categories',
        name: 'categories',
        component: Category,
        meta: {
            auth: true
        }
    },
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})
export default router
