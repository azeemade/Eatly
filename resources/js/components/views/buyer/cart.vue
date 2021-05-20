<template>
    <div class="">
        <div class="d-inline-flex">
            <button type="button" class="close my-3 float-left text-danger btn ml-3" @click="closeCart()"><span aria-hidden="true">&times;</span></button>
        </div>
        <div v-if="$store.state.cartCount > 0">
            <div class="mx-3" v-for="(meal, index) in cart" :key="index">
                <div class="d-flex">
                    <div class="col-md-4">
                        <img :src="'/images/meal/'+ meal.image" alt="" width="75" height="75" class="rounded">
                    </div>
                    <div class="col-md-8">
                        <p class="mb-0"><b>{{meal.meal_name}}</b></p>
                        <p class="mb-0">{{meal.shop_name}}</p>
                        <p class="small strong mb-0">Meal size: {{meal.size}}</p>
                        <p class="small strong mb-0">NG₦ {{meal.meal_price}}</p>
         
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-sm" @click="adjust(-1, meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                            </svg>
                        </a>
                            <input type="text" v-model="meal.quantity" class="quantity-input">
                        <a class="btn btn-sm" @click="adjust(1, meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <button class="btn btn-sm" @click.prevent="removeFromCart(meal)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </button>
                    </div>
                </div><hr>
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <p>Total:</p>
                    <p>NG₦ {{ totalPrice }}</p>
                </div>
                <button type="submit" class="btn btn-tc-dark btn-md btn-block mb-5" @click="closeCart()">
                    <router-link v-if="!isLoggedIn" :to="{name: 'login', params: {nextUrl: this.$route.fullPath}}" class="text-white" >Go to checkout</router-link>
                    <router-link v-else to="/checkout" class="text-white" >Go to checkout</router-link>
                </button>
            </div>
            <div class="alert alert-secondary text-center mb-0" role="alert" v-if="$store.state.message != null">
            <p>{{$store.state.message}}</p>
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
    data(){
        return{
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
        }
    },

    computed:{
       totalPrice(){
            var totalSum = this.$store.state.cart.reduce(function(res, meal){
                var mp = meal.meal_price.replace(",", "")
               return res + (mp * meal.quantity);
           }, 0);
           return totalSum.toLocaleString();
       },

        ...mapGetters([
            'cart'
        ])
    },
    methods: {
        adjust(n, meal){
            meal.quantity += n;
        },

        removeFromCart(meal) {
            this.$store.commit('REMOVE_CART_MEAL', meal)

            var message = "Meal removed from cart!"
            this.$store.commit('SET_MESSAGE', message)
            setTimeout(() => {
                        this.$store.state.message = null;
                    }, 3000);
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
        background-color: transparent;
    }
    .btn-tc-dark{
        background-color: #dda30e;
    }
</style>