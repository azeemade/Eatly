let getters = {
    cart: state => {
        return state.cart
    },

    vRating: state => {
        return state.vRating
    },

    sale: state => {
        return state.sale
    },

    comments: state => {
        return state.comments
    },

    recent_search: state => {
        var searches_3 = state.searches.slice(-3)
        return searches_3
    },

    user: state => {
        return state.user
    },

    favShop: state => {
        return state.favShop
    },
    favMeal: state => {
        return state.favMeal
    },

    cOrders: state => {
        return state.cOrders
    },
    oOrders: state => {
        return state.oOrders
    },

    delivered: state => {
        return state.delivered
    },
    undelivered: state => {
        return state.undelivered
    },
    vmeals: state => {
        return state.vendorMeals
    },
    selectedmeal: state => {
        return state.selectedmeal
    },
    selectedmeal_size: state => {
        return state.selectedmeal.meal_size
    },
    selectedmeal_image: state => {
        return state.selectedmeal.image
    },
    selectedmeal_categories: state => {
        return state.selectedmeal.categories
    },
    
    master_image: state => {
        return state.master_image
    },
    images: state => {
        return state.meal_images
    }
}

export default  getters