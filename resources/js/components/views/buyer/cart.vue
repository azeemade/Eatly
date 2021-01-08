<template>
    <div class="">
        <div class="d-inline-flex">
            <button type="button" class="close my-3 float-left text-danger btn ml-3" @click="closeCart()"><span aria-hidden="true">&times;</span></button>
        </div>
        <div v-if="$store.state.cartCount > 0">
            <div class="mx-3" v-for="(meal, index) in cart" :key="index">
                <div class="d-flex">
                    <div class="col-md-4">
                        <img :src="'/images/'+ meal.image" alt="" width="75" height="75" class="rounded">
                    </div>
                    <div class="col-md-8">
                        <p><b>{{meal.meal_name}}</b></p>
                        <p>{{meal.shop_name}}</p>
                        <div class="d-flex justify-content-between">
                            <p class="small strong">Meal size: {{meal.meal_size}}</p>
                            <p class="small strong">NG₦{{meal.meal_price}}</p>
                        </div>         
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-dark btn-sm" @click="adjust(-1, meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                            </svg>
                        </a>
                            <input type="text" v-model="meal.quantity" class="quantity-input">
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
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <p>Total:</p>
                    <p>NGN{{ totalPrice }}</p>
                </div>
                <button type="submit" class="btn btn-success btn-md btn-block mb-5" @click="closeCart()">
                    <router-link to="/checkout">Checkout</router-link>
                </button>
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
               return res + (meal.meal_price * meal.quantity);
           }, 0);
           return totalSum;
       },

        ...mapGetters([
            'cart'
        ])
    },
    methods: {
        adjust(n, meal){
            meal.quantity += n;

            let quantity = meal.quantity;
            let id = this.$store.state.id
            let meal_id = meal.id
            axios.put(`http://127.0.0.1:8000/api/v1/cart/update?meal_id=${meal_id}&user_id=${id}&quantity=${quantity}`)
        },

        removeFromCart(meal) {
            let quantiti = meal.quantity;
            let id = this.$store.state.id
            let meal_id = meal.id
            
            let url = `http://127.0.0.1:8000/api/v1/cart/delete?user_id=${id}&meal_id=${meal_id}&quantity=${quantity}`
            axios.delete(url)
            .then(response =>  this.$store.commit('REMOVE_MEAL', {meal}))
            alert('Meal removed')
        },

        closeCart(){
            document.getElementById('cart-content').style.display= "none";
        }
    },
}
</script>
<style scoped>
    .quantity-input{
        border: none;
        border-bottom: 1px solid;
        text-align: center;
        width: 25%;
        background-color: white;
    }
</style>