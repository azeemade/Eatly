/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './App.vue'
import router from './index'
import store from './store/index'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('navbar', require('./components/views/general/navbar.vue').default);
Vue.component('home', require('./components/views/general/home.vue').default);
Vue.component('vendorReg', require('./components/views/general/vendorReg.vue').default);
Vue.component('login', require('./components/views/general/Login.vue').default);

Vue.component('uDashboard', require('./components/views/buyer/uDashboard.vue').default);
Vue.component('uHome', require('./components/views/buyer/uHome.vue').default);
Vue.component('meals', require('./components/views/buyer/meals.vue').default);
Vue.component('meal', require('./components/views/buyer/meal.vue').default);
Vue.component('shops', require('./components/views/buyer/shops.vue').default);
Vue.component('shop', require('./components/views/buyer/shop.vue').default);
Vue.component('sidenav', require('./components/views/buyer/sidenav.vue').default);
Vue.component('cart', require('./components/views/buyer/cart.vue').default);
Vue.component('account', require('./components/views/buyer/account.vue').default);
Vue.component('orders', require('./components/views/buyer/orders.vue').default);
Vue.component('ordersOpen', require('./components/views/buyer/ordersOpen.vue').default);
Vue.component('ordersClosed', require('./components/views/buyer/ordersClosed.vue').default);
Vue.component('message', require('./components/views/buyer/message.vue').default);
Vue.component('notification', require('./components/views/buyer/notification.vue').default);
Vue.component('bookmark', require('./components/views/buyer/bookmark.vue').default);
Vue.component('checkout', require('./components/views/buyer/checkout.vue').default);
Vue.component('comment', require('./components/views/buyer/comment.vue').default);
Vue.component('rate', require('./components/views/buyer/rate.vue').default);
Vue.component('addComment', require('./components/views/buyer/addComment.vue').default);
Vue.component('shopBookmark', require('./components/views/buyer/shopBookmark.vue').default);
Vue.component('mealBookmark', require('./components/views/buyer/mealBookmark.vue').default);

Vue.component('vendorSidenav', require('./components/views/vendor/vendorSidenav.vue').default);
Vue.component('vDashboard', require('./components/views/vendor/vDashboard.vue').default);
Vue.component('vendorHome', require('./components/views/vendor/vendorHome.vue').default);
Vue.component('vMeals', require('./components/views/vendor/vMeals.vue').default);
Vue.component('vInbox', require('./components/views/vendor/vInbox.vue').default);
Vue.component('vEarnings', require('./components/views/vendor/vEarnings.vue').default);
Vue.component('vOrders', require('./components/views/vendor/vOrders.vue').default);
Vue.component('vOrdersHistory', require('./components/views/vendor/vOrdersHistory.vue').default);
Vue.component('addmeal', require('./components/views/vendor/addmeal.vue').default);
Vue.component('editmeal', require('./components/views/vendor/editmeal.vue').default);
Vue.component('vMeal', require('./components/views/vendor/vMeal.vue').default);
Vue.component('vMealRating', require('./components/views/vendor/vMealRating.vue').default);
Vue.component('vReviews', require('./components/views/vendor/vReviews.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    template: '<app></app>',
    
    components: { App },

    router, store
});
