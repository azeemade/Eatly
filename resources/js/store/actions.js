let actions = {
    setShopName({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/v1/shop/shop-name?user_id=${user_id}`)
            .then(res => {
                commit('SET_SHOP_NAME', res.data.data.shop_name)
            })
            .catch(err => {
            console.log(err)
        })
    },
    setShop({commit},id){
        let url = `http://127.0.0.1:8000/api/v1/shop/vendor?user_id=${id}`
        axios.get(url)
            .then(res => {
                commit('SET_SHOP', res.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },
    ////fetchCart({commit}, id) {
    //    let user_id = id
    //    axios.get(`http://127.0.0.1:8000/api/v1/cart/?user_id=${user_id}`)
    //        .then(res => {
    //            commit('FETCH_CART', res.data.data)
    //        }).catch(err => {
    //        console.log(err)
    //    })
    //},

    fetchFavMeal({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/v1/favourite/meals?user_id=${user_id}`)
        //axios.get(`http://127.0.0.1:8000/api/v1/favourite/meals`)
            .then(res => {
                commit('FETCH_FAV_MEAL', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchFavShop({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/v1/favourite/shops?user_id=${user_id}`)
            .then(res => {
                commit('FETCH_FAV_SHOP', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchOpenOrders({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/v1/order/user/open?user_id=${user_id}`)
            .then(res => {
                commit('FETCH_OPEN_ORDERS', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchClosedOrders({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/v1/order/user/closed?user_id=${user_id}`)
            .then(res => {
                commit('FETCH_CLOSED_ORDERS', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },



    fetchUndelivered({commit}, id) {
        axios.get(`http://127.0.0.1:8000/api/v1/order/open/?user_id=${id}`)
            .then(res => {
                commit('FETCH_UNDELIVERED', res.data.data.order)
            }).catch(err => {
            console.log(err)
        })
    },

    fetchDelivered({commit}, id) {
        axios.get(`http://127.0.0.1:8000/api/v1/order/closed/?user_id=${id}`)
            .then(res => {
                commit('FETCH_DELIVERED', res.data.data)
            }).catch(err => {
            console.log(err)
        })
    },


    fetchComments({commit}, meal_slug) {
        //let meal_id = meal.id
        axios.get(`http://127.0.0.1:8000/api/v1/comment/?meal_slug=${meal_slug}`)
            .then(res => {
                commit('FETCH_COMMENTS', res.data.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    fetchVendorMeals({commit}, shop_name) {
        axios.get(`http://127.0.0.1:8000/api/v1/meal/vendor?shop_name=${shop_name}`)
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

    fetchRecent({commit}, id) {
        let user_id = id
        axios.get(`http://127.0.0.1:8000/api/v1/search/recent?user_id=${user_id}`)
            .then(res => {
                commit('FETCH_RECENT_SEARCH', res.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    storeSearch({commit}, {id, search}) {
        let user_id = id
        let search_ = search
        axios.post(`http://127.0.0.1:8000/api/v1/search/create?user_id=${user_id}&search_title=${search_}`)
            .then(res => {
                commit('STORE_SEARCH', res.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    clearRecent({commit}, id) {
        let user_id = id
        axios.delete(`http://127.0.0.1:8000/api/v1/search/clear?user_id=${user_id}`)
            .then(res => {
                commit('CLEAR_RECENT', res.data.data)
            })
            .catch(err => {
            console.log(err)
        })
    },

    fetchUser({commit}, id){
        let url = `http://127.0.0.1:8000/api/v1/user/show?user_id=${id}`
        axios.get(url)
        .then(res => {
            commit('FETCH_USER', res.data.data)
        })
        .catch(err => {
        console.log(err)
    })
    },

    editingMeal({commit}, meal_slug){
        let url = `http://127.0.0.1:8000/api/v1/meal/edit/?meal_slug=${meal_slug}`
        axios.get(url)
        .then(res => {
            commit('EDITING_MEAL', res.data.data)
        })
        .catch(err => {
        console.log(err)
    })
    }
}

export default actions