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
}

export default actions