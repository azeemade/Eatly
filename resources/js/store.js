import Vuex from 'vuex';
var Vue = require('vue');

window.Vuex = Vuex;

Vue.use(Vuex);


let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

const store = new Vuex.Store({
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
        meals: [],
        orders: [],
    },

    mutations: {
        newMeal: (state, meal) => state.meals.unshift(meal),

        addToCart(state, meal) {
            let found = state.cart.find(product => product.id == meal.id);
        
            if (found) {
                found.quantity ++;
                found.totalPrice = found.quantity * found.price;
            } else {
                state.cart.push(meal);
        
                Vue.set(meal, 'quantity', 1);
                Vue.set(meal, 'totalPrice', meal.price);
            }
        
            state.cartCount++;
            this.commit('saveCart');
        },

        adjust(state, n){
            state.cartCount += n;
            this.commit('saveCart');
        },

        removeFromCart(state, meal) {
            let index = state.cart.indexOf(meal);
        
            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;
        
                state.cart.splice(index, 1);
            }

            this.commit('saveCart');
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },
        SET_MEALS(state, meals){
            state.meals = meals
        },
        
        SET_IDs(state, orders) {
            state.orders = orders
        },
    },

    actions:{
        async addMeal({commit}, meal){
            const response = await axios.post("http://127.0.0.1:8000/api/meal", meal);
            commit('newMeal', response.data);
        },
        getMeal({ commit }) {
            axios.get(`http://127.0.0.1:8000/api/meals`)
            .then(response => {
            commit('SET_MEALS', response.data)
            })
        },

        getUserId({ commit }, state) {
        axios.get(`http://127.0.0.1:8000/api/getOrder/${state.meals.id}`)
        .then(response => {
        commit('SET_IDs', response.data)
        })
        },
    },

    
});

export default store;