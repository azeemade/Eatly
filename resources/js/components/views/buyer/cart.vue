<template>
    <div class="">
        <div v-if="$store.state.cartCount > 0">
            <div class="cartCard" v-for="(meal, index) in $store.state.cart" :key="index">
                <div class="d-flex">
                    <div class="col-md-5">
                    <!--    <img :src="require('../../../../../public/images/' +meal.image+ '.png')" alt="" class="user_image">-->
                    </div>
                    <div class="col-md-7">
                        <p><b>{{meal.name}}</b></p>
                        <p>NG₦{{meal.price}}</p>
                    </div>
                </div><hr>
                <div class="d-flex justify-content-between mx-3">
                    <div>
                        <a class="btn btn-dark btn-sm" @click="adjust(-1, meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                            </svg>
                        </a>
                            <input type="text" v-model="meal.quantity" style="width: 30px">
                        <a class="btn btn-dark btn-sm" @click="adjust(1, meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <button class="btn btn-danger btn-sm" @click.prevent="removeFromCart(meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </button>
                    </div>
                </div><hr>
            </div><hr class="bg-success">
            <div>
                <div class="d-flex justify-content-between">
                    <p>Total:</p>
                    <p>NGN{{ totalPrice }}</p>
                </div>
                <router-link to="/checkout" class="btn btn-success btn-lg">Checkout</router-link>
            </div>
        </div>
        <div v-else class="navbar-dropdown">
            <a class="navbar-item" href="">
                Cart is empty
            </a>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    props:['id'],
    computed:{
       totalPrice(){
            var totalSum = this.$store.state.cart.reduce(function(res, meal){
               return res + (meal.price * meal.quantity);
           }, 0);
           return totalSum;
       },
    },
    methods: {
        adjust(n, meal){
            meal.quantity += n;

            let quantiti = meal.quantity;
            let id = this.$store.state.id
            let meal_id = meal.id
            axios.put(`http://127.0.0.1:8000/api/cart/${meal.id}`, {meal_id, id, quantiti})
        },

        removeFromCart(meal) {
           axios.delete(`http://127.0.0.1:8000/api/cart/${meal.id}?id=${this.id}&meal_id=${meal.id}&quantity=${meal.pivot.quantity}`)
           .then(response =>  this.$store.commit('REMOVE_MEAL', {meal}))
           alert('Meal removed')
        },
    },
}
</script>
<style scoped>
    .user_image{
        width: 100px;
        height: 100px;
        border-radius: 4px;
    }
    .cartCard{
        border-radius: 4px;
        background-color: #80808033;
        margin: 1rem;
    }
</style>