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
import Favourites from "./components/views/buyer/favourites.vue"
import mealFav from "./components/views/buyer/mealFav.vue"
import shopFav from "./components/views/buyer/shopFav.vue"
import openOrders from "./components/views/buyer/ordersOpen.vue"
import closedOrders from "./components/views/buyer/ordersClosed.vue"
import orders from "./components/views/buyer/orders.vue"
import notification from "./components/views/buyer/notification.vue"
import uHome from "./components/views/buyer/uHome";
import checkout from "./components/views/buyer/checkout";
import Category from "./components/views/buyer/category";
import Search from "./components/views/buyer/search";

import vHome from "./components/views/vendor/vendorHome.vue"
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
            path: '/i/listings/:meal_slug',
            name: 'imeal', 
            component: Meal,
        },
        {
            path: '/i/shop/:shop_name', 
            name: 'ishop',
            component: Shop,
        },
        {
            path: '/i/category/:title', 
            name: 'icategory',
            component: Category,
        },
        {
            path: '/uDashboard', 
            name: 'uDashboard',
            component: uDashboard,
            children: [
                {
                    path: '/home',
                    name: 'uHome', 
                    component: uHome,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/search',
                    name: 'search', 
                    component: Search,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/meals',
                    name: 'meals', 
                    component: Meals,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/listings/:meal_slug',
                    name: 'meal', 
                    component: Meal,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/category/:title', 
                    name: 'category',
                    component: Category,
                    meta: {
                         requiresAuth: true,
                         is_user: true,
                         name: 'uDashboard',
                     }
                },

                {
                    path: '/shops', 
                    name: 'shops',
                    component: Shops,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/shop/:shop_name', 
                    name: 'shop',
                    component: Shop,
                    meta: {
                        requiresAuth: true,
                        is_consumer: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/cart', 
                    name: 'cart',
                    component: cart,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/favourites', 
                    name: 'favourites',
                    component: Favourites,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    },
                    children: [
                        {
                            path: '/favourites/meal', 
                            name: 'mealFav',
                            component: mealFav,
                            meta: {
                                requiresAuth: true,
                                is_user: true,
                                name: 'uDashboard',
                            },
                        },
                        {
                            path: '/favourites/shop', 
                            name: 'shopFav',
                            component: shopFav,
                            meta: {
                                requiresAuth: true,
                                is_user: true,
                                name: 'uDashboard',
                            },
                        },
                    ]
                },
                {
                    path: '/checkout', 
                    name: 'checkout',
                    component: checkout,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    }
                },
                {
                    path: '/orders', 
                    name: 'orders',
                    component: orders,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'uDashboard',
                    },
                    children: [
                        {
                            path: '/openOrders', 
                            name: 'openOrders',
                            component: openOrders,
                            meta: {
                                requiresAuth: true,
                                is_user: true,
                                name: 'uDashboard',
                            },
                        },
                        {
                            path: '/closedOrders', 
                            name: 'closedOrders',
                            component: closedOrders,
                            meta: {
                                requiresAuth: true,
                                is_user: true,
                                name: 'uDashboard',
                            },
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
            path: '/vDashboard',
            name: 'vDashboard',
            component: vDashboard,
            children: [
                {
                    path: '/vendor/:shop_name/home',
                    name: 'vHome', 
                    component: vHome,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'vDashboard',
                    },
                },
                {
                    path: '/vendor/meals',
                    name: 'vMeals', 
                    component: vMeals,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'vDashboard',
                    },
                },
                {
                    path: '/vendor/orders',
                    name: 'vOrders', 
                    component: vOrders,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'vDashboard',
                    },
                    props: (route) => ({ pid: route.query.pid })
                },
                {
                    path: '/vendor/add-meal',
                    name: 'addmeal', 
                    component: addmeal,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'vDashboard',
                    }
                },
                {
                    path: '/vendor/edit-meal/:id',
                    name: 'editmeal', 
                    component: editmeal,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'vDashboard',
                    }
                },
                {
                    path: '/vendor/earnings',
                    name: 'vEarnings', 
                    component: vEarnings,
                    meta: {
                        requiresAuth: true,
                        is_user: true,
                        name: 'vDashboard',
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
                else if (to.matched.some(record => record.meta.is_user)){
                    if (user.role == "user"){
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