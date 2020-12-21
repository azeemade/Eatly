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

    commentsDate: (state, getters) =>{
        var created_at = getters.comments.created_at;
        var event = new Date(created_at);
        var datee = state.months[event.getMonth()]+' '+event.getDay()+' '+event.getFullYear();
        return datee
    }

}

export default  getters