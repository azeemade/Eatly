import VueRouter from 'vue-router'

import Home from "./components/views/general/home.vue"
import vendorReg from "./components/views/general/vendorReg.vue"
import login from "./components/views/general/Login.vue"

import uDashboard from "./components/views/buyer/uDashboard.vue"
import Meal from "./components/views/buyer/meal.vue"
import Meals from "./components/views/buyer/meals.vue"
import Shops from "./components/views/buyer/shops.vue"
import Shop from "./components/views/buyer/shop.vue"
import cart from "./components/views/buyer/cart.vue"
import message from "./components/views/buyer/message.vue"
import bookmark from "./components/views/buyer/bookmark.vue"
import mealBookmark from "./components/views/buyer/mealBookmark.vue"
import shopBookmark from "./components/views/buyer/shopBookmark.vue"
import openOrders from "./components/views/buyer/ordersOpen.vue"
import closedOrders from "./components/views/buyer/ordersClosed.vue"
import orders from "./components/views/buyer/orders.vue"
import notification from "./components/views/buyer/notification.vue"
import uHome from "./components/views/buyer/uHome";
import checkout from "./components/views/buyer/checkout";
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
                    path: '/shops', 
                    name: 'shops',
                    component: Shops,
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
                {
                    path: '/bookmark', 
                    name: 'bookmark',
                    component: bookmark,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    },
                    children: [
                        {
                            path: '/bookmark/meal', 
                            name: 'mealBookmark',
                            component: mealBookmark,
                        },
                        {
                            path: '/bookmark/shop', 
                            name: 'shopBookmark',
                            component: shopBookmark,
                        },
                    ]
                },
                {
                    path: '/checkout', 
                    name: 'checkout',
                    component: checkout,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    }
                },
                {
                    path: '/orders', 
                    name: 'orders',
                    component: orders,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true
                    },
                    children: [
                        {
                            path: '/openOrders', 
                            name: 'openOrders',
                            component: openOrders,
                        },
                        {
                            path: '/closedOrders', 
                            name: 'closedOrders',
                            component: closedOrders,
                        },
                    ]
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
               // {
               //     path: '/subscriptions', 
               //     name: 'subscriptions',
               //     component: subscriptions,
                //    meta: {
                //        requiresAuth: true,
               //         is_consumer: true
                //    }
               // },
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
                if (to.matched.some(record => record.meta.is_admin)){
                    if (user.role == "admin"){
                        next()
                    }
                    else{ 
                    next({ path: '/home' })
                    }
                }
                else if (to.matched.some(record => record.meta.is_consumer || record.meta.is_vendor)){
                    if (user.role == "consumer" || user.role == "vendor"){
                        next()
                    }
                    else {
                        next({ path: 'admin' })
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