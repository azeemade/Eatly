let mutations = { 
    SET_ID(state, id){
        state.id = id
    },

    SET_MEAL_SLUG(state, meal_slug){
        state.meal_slug = meal_slug
    },


    ADD_TO_CART(state, {meal, quantity, size}) {
        state.cart.push(meal)
        Vue.set(meal, 'quantity', quantity);
        Vue.set(meal, 'size', size);
        state.cartCount++;

        this.commit('SAVE_CART');
    },

    UPDATE_CART({meal, quantity}){
        meal.quantity += quantity;
       //Vue.set(meal, 'quantity', quantity);
        this.commit('SAVE_CART');
    },

    SAVE_CART(state){
        window.localStorage.setItem('cart', JSON.stringify(state.cart));
        window.localStorage.setItem('cartCount', state.cartCount)
    },

    FETCH_CART(state, cart){
        state.cartCount = cart.length;
        return state.cart = cart
    },

    ADD_MEAL_TO_FAVOURITE(state, {meal}) {
        state.favMeal.push(meal)
    },

    FETCH_FAV_MEAL(state, meal){
        return state.favMeal = meal
    },

    REMOVE_MEAL_FAVOURITE(state, meal) {
        let index = state.favMeal.indexOf(meal);
    
        state.favMeal.splice(index, 1);
    },


    ADD_SHOP_TO_FAVOURITE(state, {shop}) {
        state.favShop.push(shop)
    },

    FETCH_FAV_SHOP(state, shop){
        return state.favShop = shop
    },

    REMOVE_SHOP_FAVOURITE(state, shop) {
        let index = state.favShop.indexOf(shop);
    
        state.favShop.splice(index, 1);
    },


    REMOVE_MEAL(state, meal) {
        let index = state.cart.indexOf(meal);
    
        state.cart.splice(index, 1);
        state.cartCount--;

        this.commit('SAVE_CART');
    },
    

    ADD_TO_COMMENTS(state, newComment_) {
        state.comments.push(newComment_)
    },

    FETCH_COMMENTS(state, comments){
        return state.comments = comments
    },


    ADD_RATING(state, points) {
        state.ratings.push(points)
    },

    FETCH_RATINGS(state, points){
        return state.ratings = points
    },


    SET_VENDOR_MEAL(state, meal){
        state.vMeal = meal
    },

    FETCH_VENDOR_MEALS(state, meals){
        return state.vMeals = meals
    },

    REMOVE_VENDOR_MEAL(state, meal){
        let index = state.vMeals.indexOf(meal);
    
        state.vMeals.splice(index, 1);
        //this.commit("FETCH_VENDOR_MEALS", meals)
    },


    FETCH_SALE(state, sale){
        return state.sale = sale
    },

    FETCH_VENDOR_RATING(state, rating){
        return state.vRating = rating
       // state.vRating = rating
    },

    SET_MESSAGE(state, message){
        return state.message = message
    },


    CLEAR_RECENT(state, search){
        let index = state.searches.indexOf(search);
    
        state.searches.splice(index, 1);
    },
    STORE_SEARCH(state, search){
        state.searches.push(search)

        this.commit('SAVE_SEARCH');
    },
    SAVE_SEARCH(state){
        window.localStorage.setItem('search', JSON.stringify(state.searches));
    },
    FETCH_RECENT_SEARCH(state, search){
        return state.searches = search
    },
    NEW_SEARCH(state, search){
        return state.search = search
    },


    FETCH_USER(state, user){
        return state.user = user
    },

    FETCH_OPEN_ORDERS(state, oOrders){
        return state.oOrders = oOrders
    },
    FETCH_CLOSED_ORDERS(state, cOrders){
        return state.cOrders = cOrders
    },
    CANCEL_ORDER(state, order){
        let index = state.oOrders.indexOf(order);
    
        state.oOrders.splice(index, 1);
    },

    SET_SHOP_NAME(state, shop_name){
        state.shop_name = shop_name
    }
    
}
export default mutations