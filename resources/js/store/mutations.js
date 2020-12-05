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


    REMOVE_MEAL(state, meal) {
        let index = state.cart.indexOf(meal);
    
        state.cart.splice(index, 1);
        state.cartCount--;
    },

    ADD_TO_COMMENTS(state, {newComment_}) {
        state.comments.push(newComment_)
    },

    FETCH_COMMENTS(state, comments){
        return state.comments = comments
    },
}
export default mutations