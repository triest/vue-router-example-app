import AllProduct from './components/AllProduct.vue';
import CreateProduct from './components/CreateProduct.vue';
import EditProduct from './components/EditProduct.vue';
import Register from './components/Auth/Register.vue';
import Vue from 'vue'
import Profile from "./components/Auth/Profile";
import Dating from "./components/Dating";
import Anket from "./components/Anket"

Vue.component('app', require('./App.vue').default);

export const routes = [

    {
        name: 'home',
        path: '/',
        component: AllProduct
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct
    },
    {
        name:'register',
        path: '/register',
        component: Register
    },
    {
        name:'profile',
        path: '/profile',
        component: Profile
    },
    {
        name:'dating',
        path: '/dating',
        component: Dating
    },
    {
        name: 'anket',
        path: '/anket/:unique_id',
        component: Anket
    }
];
