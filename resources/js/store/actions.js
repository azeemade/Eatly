let actions = {
    fetchCart({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/cart?id=${user_id}`)
            .then(res => {
                commit('FETCH_CART', res.data.data.cart)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchBookmarkMeal({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/bookmark/meals?id=${user_id}`)
            .then(res => {
                commit('FETCH_BOOKMARK_MEAL', res.data.data.bookmarkMeal)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchBookmarkShop({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/bookmark/shops?id=${user_id}`)
            .then(res => {
                commit('FETCH_BOOKMARK_SHOP', res.data.data.bookmarkShop)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchRatings({commit}, meal_id) {
        axios.get(`http://127.0.0.1:8000/api/bookmark/shops?id=${meal_id}`)
            .then(res => {
                commit('FETCH_RATINGS', res.data.data.ratings)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchComments({commit}, meal) {
        let meal_id = meal.id
        axios.get(`http://127.0.0.1:8000/api/comments?id=${meal_id}`)
            .then(res => {
                commit('FETCH_COMMENTS', res.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    fetchVMeals({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/store/${user_id}`)
            .then(res => {
                commit('FETCH_VENDOR_MEALS', res.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    fetchSale({commit}, meal) {
        let meal_id = meal.id
        axios.get(`http://127.0.0.1:8000/api/meal/sales?id=${meal_id}`)
            .then(res => {
                commit('FETCH_SALE', res.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    fetchVRating({commit}, meal) {
        let meal_id = meal.id
        axios.get(`http://127.0.0.1:8000/api/meal/rating?id=${meal_id}`)
        //axios.get(`http://127.0.0.1:8000/api/meal/sales?id=${meal_id}`)
            .then(res => {
                commit('FETCH_VENDOR_RATING', res.data)
            })
            .catch(err => {
            console.log(err)
        })
    },
}

export default actions