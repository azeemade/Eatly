<template>
    <div>
        <div class="mb-3">
            <h4 class="text-center">Checkout</h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h4>Billing address</h4>
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="">First name</label>
                                <input type="text" class="form-control" v-model="user.firstname">
                            </div>
                            <div class="col-md-6">
                                <label for="">Last name</label>
                                <input type="text" class="form-control" v-model="user.lastname" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control"  placeholder="you@example.com" width="45%"  v-model="user.email">
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone number</label>
                                <input type="text" class="form-control"  v-model="user.phoneNumber">
                            </div>
                        </div>
                        <div>
                            <label for="">Address</label>
                            <input type="text" class="form-control" v-model="bAddress">
                        </div><hr class="my-5">
                        <div class="checkbox mb-3">
                            <label for="">
                                <input type="checkbox" name="" id="addrHide" @click="hide(), sAddress = bAddress">
                                Shipping address is the same as my billing address
                            </label>
                        </div>
                        <div class="mb-5">
                            <label for="">Shipping address</label>
                            <input type="text" class="form-control" placeholder="shipping address" id="addrInput" v-model="sAddress">
                        </div>
                        <div>
                            <h4>Payment</h4>
                            <div class="custom-radio">
                                <label for="">
                                    <input type="radio" name="payType" class="ccPay" id="creditCard" value="credit-card" @change="ccPay" v-model="payType">
                                    Credit card
                                </label>
                            </div>
                            <div class="custom-radio">
                                <label for="">
                                    <input type="radio" name="payType" class="btPay" @change="btPay(), nameCard=ccn=exp=ccv= null" v-model="payType" id="bankTransfer" value="bank-transfer">
                                    Bank transfer
                                </label>
                            </div>
                            <div id="ccPay">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Name on card</label>
                                        <input type="text" class="form-control" v-model="nameCard">
                                        <small>Full name as displayed on card</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Credit card number</label>
                                        <input type="text" class="form-control" v-model="ccn">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Expiration</label>
                                        <input type="text" class="form-control" v-model="exp">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">ccv</label>
                                        <input type="text" class="form-control" v-model="ccv">
                                    </div>
                                </div>
                            </div>
                            <div id="btPay">
                                <h6 class="pt-2">Account name: <b>Eatly Inc.</b></h6>
                                <h6>Account number: <b>0x xxx xxx xx</b></h6>
                                <h6 class="pb-2">Bank name: PACIFICA Bank</h6>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <h4 class="text-center">Cart</h4>
                    <div class="v-meal-card p-2 meal-image mb-3" v-for="(meal, index) in $store.state.cart" :key="index">
                        <div class="row">
                        <div class="col-md-4 col-5">
                            <img :src="'/images/meal/'+ meal.image" alt="" width="100" height="100" class="rounded">
                        </div>
                        <div class="mb-0 col-md-8 col-7">
                            <div>
                                <p class="mb-0">{{meal.meal_name}}</p>
                                <p class="mb-0">Size: {{meal.size}}</p>
                                <p class="mb-0"><b>NG₦ {{meal.meal_price}}</b></p>
                                <p class="mb-0">Quantity: {{meal.quantity}}</p>
                            </div>                     
                        </div>
                    </div>  
                    </div>
                    <div>
                        <h6><b>Total: NGN{{totalPrice}}</b></h6>
                    </div><br>
                    <div class="d-flex">
                        <input type="text" name="" placeholder="Promo code" class="form-control" width="75%">
                        <button class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center alert alert-danger" v-bind:class="{hidden: hasError}">Please fill all the fields.</p>
        <div>
            <button class="btn btn-lg btn-success btn-block my-3" @click="placeOrder">Checkout</button>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            hasError: true,
            user: {},
            ccv: "",
            ccn: "",
            exp: "",
            nameCard: "",
            sAddress: "",
            bAddress: "",
            payType: "",
        }
    },

    methods:{
        placeOrder(){
            var item = this.user;
            if (item['firstname'] == '' || item['lastname'] == '' || item['email'] == '' || item['phoneNumber'] == ''
            || this.ccv == '' || this.ccn == '' || this.exp == '' || this.nameCard == '' || this.sAddress == '' || this.bAddress == ''){
                this.hasError = false;
            }
            else {
              this.hasError = true;
                axios.post(`/api/v1/user/create?user_id=${this.$store.state.id}`, {
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                   phoneNumber: this.user.phoneNumber
                })


                let cart_ = this.$store.state.cart;
                for(var meal in cart_){
                    let user_id = this.$store.state.id;
                    axios.post(`/api/v1/order/checkout/`, {
                        user_id: user_id,
                        meal_id: cart_[meal].id,
                        shop_id: cart_[meal].shop_id,
                        quantity: cart_[meal].quantity,
                        meal_size_id: cart_[meal].size_id,
                        shippingAddress: this.sAddress,
                        billingAddress: this.bAddress,
                        paymentType: this.payType,
                        nameOnCard: this.nameCard,
                        cardNumber: this.ccn,
                        cardExpiration: this.exp,
                        ccv: this.ccv
                    })
                     .then(response => {
                        for(var meal in cart_){
                            this.$store.commit('REMOVE_CART_MEAL', cart_[meal]);
                        }
                            this.$router.push({name: 'uHome'})

                            var message = "Your meal order has been placed!"
                            this.$store.commit('SET_MESSAGE', message)
                            setTimeout(() => {
                                this.$store.state.message = null;
                            }, 3000);
                    })
                }
            }
        },

        hide(){
            var x = document.getElementById('addrInput');
            if (x.disabled === true){
                x.disabled = false
            }else{
                x.disabled = true
            }
        },

        ccPay(){
            document.getElementById("ccPay").style.display = 'block';
            document.getElementById("btPay").style.display = 'none';
        },

        btPay(){
            document.getElementById("btPay").style.display = 'block';
            document.getElementById("ccPay").style.display = 'none';
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
    },

    mounted(){
        axios.get(`/api/v1/user/show?user_id=${this.$store.state.id}`)
        .then(response => this.user = response.data.data)
    }
}
</script>
<style scoped>
    .mealRow{
        background-color: lightgrey;
        border-radius: 4px;
    }
    .container{
        max-width: 960px;
    }
    #btPay{
        display: none;
        background-color: lightgray;
        text-align: center;
        border-radius: 4px;
    }
    #ccPay{
        display: none;
    }
    .hidden{
        display: none;
    }
    .v-meal-card{
        border: 0.5px solid #a98629;
    }
</style>