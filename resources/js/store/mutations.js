let mutations = { 
    SET_ID(state, id){
        state.id = id
    },

    SET_MEAL_ID(state, meal_id){
        state.meal_id = meal_id
    },


    ADD_TO_CART(state, {meal, quantity}) {
        state.cart.push(meal)
       Vue.set(meal, 'quantity', quantity);
        state.cartCount++;
    },

    FETCH_CART(state, cart){
        state.cartCount = cart.length;
        return state.cart = cart
    },

    ADD_TO_BOOKMARK_MEAL(state, {meal}) {
        state.bookmarkMeal.push(meal)
    },

    FETCH_BOOKMARK_MEAL(state, meal){
        return state.bookmarkMeal = meal
    },

    REMOVE_MEAL_BOOKMARK(state, meal) {
        let index = state.bookmarkMeal.indexOf(meal);
    
        state.bookmarkMeal.splice(index, 1);
    },


    ADD_TO_BOOKMARK_SHOP(state, {shop}) {
        state.bookmarkShop.push(shop)
    },

    FETCH_BOOKMARK_SHOP(state, shop){
        return state.bookmarkShop = shop
    },

    REMOVE_SHOP_BOOKMARK(state, shop) {
        let index = state.bookmarkShop.indexOf(shop);
    
        state.bookmarkShop.splice(index, 1);
    },


    REMOVE_MEAL(state, meal) {
        let index = state.cart.indexOf(meal);
    
        state.cart.splice(index, 1);
        state.cartCount--;
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
    }
}
export default mutations