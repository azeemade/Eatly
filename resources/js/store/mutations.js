let mutations = { 
    SET_ID(state){
        let loggedIn = localStorage.getItem('eatly.jwt') != null
        if (loggedIn){
            let user = JSON.parse(localStorage.getItem('eatly.user'))
            state.id = user.id
        }
    },

    SET_MEAL_SLUG(state, meal_slug){
        state.meal_slug = meal_slug
    },

    SET_SHOP_NAME(state, shop_name){
        state.shop_name = shop_name
    },
    SET_SHOP(state, shop){
        state.shop = shop
    },

    SET_MASTER_IMAGE(state, files){
        state.master_image = files
    },
    SET_IMAGES(state, files){   
        state.meal_images.push(files)
    },
    REMOVE_IMAGE(state, index) {
        state.meal_images.splice(index, 1);
    },
    REMOVE_FROM_IMAGES(state, index) {
        state.selectedmeal_image.splice(index, 1);
    },

    ADD_SIZE(state){
        state.selectedmeal.meal_size.push({ meal_size: '', meal_price: ''  });
    },
    REMOVE_SIZE(state, index){
        state.selectedmeal.meal_size.splice(index, 1);
    },


    ADD_TO_CART(state, {meal, quantity, size_id, size}) {
        let found = state.cart.find(item => item.id == meal.id && item.size == size);

        if (found) {
            found.quantity += quantity;
        } else {
            state.cart.push(meal)
            Vue.set(meal, 'quantity', quantity);
            Vue.set(meal, 'size', size);
            Vue.set(meal, 'size_id', size_id);
            state.cartCount++;
        }      
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


    REMOVE_CART_MEAL(state, meal) {
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

    EDITING_MEAL(state, meal){
        return state.selectedmeal = meal
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
        return state.vendorMeals = meals
    },

    REMOVE_MEAL(state, meal){
        let index = state.vendorMeals.indexOf(meal);
    
        state.vendorMeals.splice(index, 1);
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


    
    FETCH_UNDELIVERED(state, uOrders){
        return state.undelivered = uOrders
    },
    FETCH_DELIVERED(state, dOrders){
        return state.delivered = dOrders
    },
}
export default mutations