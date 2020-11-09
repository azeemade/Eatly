import VueRouter from 'vue-router'

import Home from "./components/views/general/home.vue"
import vendorReg from "./components/views/general/vendorReg.vue"
import login from "./components/views/general/Login.vue"

import uDashboard from "./components/views/buyer/uDashboard.vue"
import Meal from "./components/views/buyer/meal.vue"
import Meals from "./components/views/buyer/meals.vue"
import Shop from "./components/views/buyer/shop.vue"
import cart from "./components/views/buyer/cart.vue"
import message from "./components/views/buyer/message.vue"
import subscriptions from "./components/views/buyer/subscriptions.vue"
import notification from "./components/views/buyer/notification.vue"
import uHome from "./components/views/buyer/uHome";
import rHome from "./components/views/RECIPE/rHome";

import vendorHome from "./components/views/vendor/vendorHome.vue"
import vDashboard from "./components/views/vendor/vDashboard.vue"
import vMeals from "./components/views/vendor/vMeals.vue"
import vOrders from "./components/views/vendor/vOrders.vue"
import addmeal from "./components/views/vendor/addmeal.vue"
import editmeal from "./components/views/vendor/editmeal.vue"
import vEarnings from "./components/views/vendor/vEarnings.vue"


var Vue = require('vue');
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path: '/', 
            component: Home
        },
        {
            path: '/uDashboard', 
            name: 'Dashboard',
            component: uDashboard,
            children: [
                {
                    path: '/home',
                    name: 'uHome', 
                    component: uHome,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                {
                    path: '/recipes',
                    name: 'rHome', 
                    component: rHome,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                {
                    path: '/meals',
                    name: 'meals', 
                    component: Meals,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                {
                    path: '/meal/:id',
                    name: 'meal', 
                    component: Meal,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                {
                    path: '/shop/:id', 
                    name: 'shop',
                    component: Shop,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                {
                    path: '/cart', 
                    name: 'cart',
                    component: cart,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                //{
                 //   path: '/inbox', 
                  //  name: 'message',
                  //  component: message,
                   // meta: {
                   //     requiresAuth: true,
                   //     is_consumer: true
                  //  }
              //  },
               // {
                   // path: '/notification', 
                  //  name: 'notification',
                  //  component: notification,
                  //  meta: {
                   //     requiresAuth: true,
                   //     is_consumer: true
                   // }
               // },
                {
                    path: '/subscriptions', 
                    name: 'subscriptions',
                    component: subscriptions,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
            ]
        },
        {
            path: '/login', 
            name: 'login',
            component: login
        },
        {
            path: '/register/vendor', 
            name: 'vendorReg',
            component: vendorReg
        },
        {
            path: '/vdashboard',
            name: 'vendorHome',
            component: vendorHome,
            children: [
                {
                    path: '/vendor/home',
                    name: 'vDashboard', 
                    component: vDashboard,
                    meta: {
                        requiresAuth: true,
                        is_vendor: true
                    },
                    props: (route) => ({ pid: route.query.pid })
                },
                {
                    path: '/vendor/meals',
                    name: 'vMeals', 
                    component: vMeals,
                    meta: {
                        requiresAuth: true,
                        is_vendor: true
                    },
                    props: (route) => ({ pid: route.query.pid })
                },
               // {
                 //   path: '/vendor/inbox',
                 //   name: 'vInbox', 
                  //  component: vInbox,
                 //   meta: {
                 //       requiresAuth: true,
                  //      is_vendor: true
                   // }
                //},
                {
                    path: '/vendor/orders',
                    name: 'vOrders', 
                    component: vOrders,
                    meta: {
                        requiresAuth: true,
                        is_vendor: true
                    },
                    props: (route) => ({ pid: route.query.pid })
                },
                {
                    path: '/vendor/add-meal',
                    name: 'addmeal', 
                    component: addmeal,
                    meta: {
                        requiresAuth: true,
                        is_vendor: true
                    }
                },
                {
                    path: '/vendor/edit-meal/:id',
                    name: 'editmeal', 
                    component: editmeal,
                    meta: {
                        requiresAuth: true,
                        is_vendor: true
                    }
                },
                {
                    path: '/vendor/earnings',
                    name: 'vEarnings', 
                    component: vEarnings,
                    meta: {
                        requiresAuth: true,
                        is_vendor: true
                    }
                },
            ]
        },
    ]
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)){
        if (localStorage.getItem('eatly.jwt') == null){
            next({
                path:'/login',
                params: { nextUrl: to.fullPath}
            })
        }
        else{
            let user = JSON.parse(localStorage.getItem('eatly.user'))
            //if (to.matched.some(record => record.meta.is_admin)){
                if (to.matched.some(record => record.meta.is_admin)){
                //if (user.is_admin == 1){
                if (user.role == "admin"){
                    next()
                }
                else{
                    if (user.role == "consumer"){
                        next({ path: '/home' })
                    }
                    else{
                        //next({ path: 'home' })
                        next({ path: 'vendor/home' })
                    }   
                }
            }
            else if (to.matched.some(record => record.meta.is_consumer)){
                if (user.role == "consumer"){
                    next()
                }
                else {
                    if (user.role == "admin"){
                        next({ path: 'admin' })
                    }
                    else{
                        //next({ path: 'home' })
                        next({ path: 'vendor/home' })
                    }   
                }
            }
            else if (to.matched.some(record => record.meta.is_vendor)){
                if (user.role == "vendor"){
                    next()
                }
                else {
                    if (user.role == "admin"){
                        next({ path: 'admin' })
                    }
                    else{
                        next({ path: '/home' })
                    }
                }
            }
            next()
        }
    }
    else {
        next()
    }
})

export default router