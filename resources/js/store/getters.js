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
}

export default  getters