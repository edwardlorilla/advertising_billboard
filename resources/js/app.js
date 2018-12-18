/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import VueRouter from 'vue-router'
Vue.use(ElementUI, {locale})
Vue.use(VueRouter)
const routes = [
    {
        path: '/',
        component: resolve => require(["./components/agencies/index.vue"], resolve),
        children: [
            {
                path: '',
                name: 'view-agency',
                component: resolve => require(["./components/agencies/view.vue"], resolve),
            },
            {
                path: 'create',
                name: 'create-agency',
                component: resolve => require(["./components/agencies/create.vue"], resolve),
            },
            {
                path: 'edit/:id',
                name: 'edit-agency',
                component: resolve => require(["./components/agencies/create.vue"], resolve),
            },
        ]
    },{
        path: '/billboards',
        component: resolve => require(["./components/billboard/index.vue"], resolve),
        children: [
            {
                path: '',
                name: 'view-billboard',
                component: resolve => require(["./components/billboard/view.vue"], resolve),
            },
            {
                path: 'create',
                name: 'create-billboard',
                component: resolve => require(["./components/billboard/create.vue"], resolve),
            },
            {
                path: 'edit/:id',
                name: 'edit-billboard',
                component: resolve => require(["./components/billboard/create.vue"], resolve),
            },
        ]
    },{
        path: '/billboard-hires',
        component: resolve => require(["./components/billboardhired/index.vue"], resolve),
        children: [
            {
                path: '',
                name: 'view-billboardhired',
                component: resolve => require(["./components/billboardhired/view.vue"], resolve),
            },
            {
                path: 'create',
                name: 'create-billboardhired',
                component: resolve => require(["./components/billboardhired/create.vue"], resolve),
            },
            {
                path: 'edit/:id',
                name: 'edit-billboardhired',
                component: resolve => require(["./components/billboardhired/create.vue"], resolve),
            },
        ]
    },
    {
        path: '/clients',
        component: resolve => require(["./components/client/index.vue"], resolve),
        children: [
            {
                path: '',
                name: 'view-client',
                component: resolve => require(["./components/client/view.vue"], resolve),
            },
            {
                path: 'create',
                name: 'create-client',
                component: resolve => require(["./components/client/create.vue"], resolve),
            },
            {
                path: 'edit/:id',
                name: 'edit-client',
                component: resolve => require(["./components/client/create.vue"], resolve),
            },
        ]
    },{
        path: '/invoices',
        component: resolve => require(["./components/invoice/index.vue"], resolve),
        children: [
            {
                path: '',
                name: 'view-invoice',
                component: resolve => require(["./components/invoice/view.vue"], resolve),
            },
            {
                path: 'create',
                name: 'create-invoice',
                component: resolve => require(["./components/invoice/create.vue"], resolve),
            },
            {
                path: 'edit/:id',
                name: 'edit-invoice',
                component: resolve => require(["./components/invoice/create.vue"], resolve),
            },
        ]
    },
    {
        path: '/payments',
        component: resolve => require(["./components/payment/index.vue"], resolve),
        children: [
            {
                path: '',
                name: 'view-payment',
                component: resolve => require(["./components/payment/view.vue"], resolve),
            },
            {
                path: 'create',
                name: 'create-payment',
                component: resolve => require(["./components/payment/create.vue"], resolve),
            },
            {
                path: 'edit/:id',
                name: 'edit-payment',
                component: resolve => require(["./components/payment/create.vue"], resolve),
            },
        ]
    },
];
const router = new VueRouter({
    mode: 'history',
    routes
})

$(window).on('load', function () {
    new Vue({
        el: '#app',
        data(){
            return {
                validate:{
                    required: [
                        {required: true}
                    ]
                }
            }
        },
        router,
        render: h => h(require('./components/App.vue'))
    });
});