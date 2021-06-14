import AllProduct from './components/AllProduct.vue';
import CreateProduct from './components/CreateProduct.vue';
import EditProduct from './components/EditProduct.vue';
import Register from './components/Auth/Register.vue';
import Vue from 'vue'
import Profile from "./components/Auth/Profile";
import Dating from "./components/dating/Dating";
import Anket from "./components/Anket"

Vue.component('app', require('./App.vue').default);

export const routes = [

    {
        name: 'home',
        path: '/',
        component: AllProduct,
        meta: {title: 'Главная'}
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct,
        meta: {title: 'About'}
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct,
        meta: {title: 'About'}
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {title: 'Регистрация'}
    },
    {
        name: 'profile',
        path: '/profile',
        component: Profile,
        meta: {title: 'Моя анкета'}
    },
    {
        name: 'dating',
        path: '/dating',
        component: Dating,
        meta: {title: 'Знакомства'}
    },
    {
        name: 'anket',
        path: '/anket/:unique_id',
        component: Anket,
        meta: {title: 'About'}
    }
];


