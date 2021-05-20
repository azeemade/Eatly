<template>
    <div>
        <div class="d-flex">
            <div class="mr-2">
                <img :src="`/images/${shop.image}.jpg`" alt="" height="75" width="75" class="rounded-circle">  
            </div>
            <div>
                <p>Greetings !</p>
                <router-link to="/vendor/profile">
                    <h4 class="shop_name">{{shop.shop_name}}</h4>
                </router-link>
            </div>      
        </div>
        <div class="row mt-3">
            <div class="col-md-8 mb-5 py-1">
                <div class="sr-card px-2">
                    <div class="float-right">
                        <star-rating
                            v-model="ratings" :read-only="true" 
                            :increment="0.5" :star-size="20">
                        </star-rating>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Shop rating</h6>
                    </div>
                </div>              
            </div>
            <div class="col-md-4">
                <input type="month" name="filtermonth" class="form-control month-input" v-model="month" @change="loadShopData()">
            </div>          
        </div>
        <div class="row mt-3">
            <div class="col-md-4 col-6 mb-5 py-1">
                <div class="si-card px-2">
                    <div class="float-right">
                        <h6 class="mb-0">{{shopData.undelivered}}</h6>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Undelivered Orders</h6>
                    </div>
                </div>               
            </div>
            <div class="col-md-4 col-6 mb-5 py-1">
                <div class="si-card px-2">
                    <div class="float-right">
                        <h6 class="mb-0">{{shopData.reviews}}</h6>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Reviews</h6>
                    </div>
                </div>
            </div>    
            <div class="col-md-4 col-6 mb-5 py-1">
                <div class="si-card px-2">
                    <div class="float-right">
                        <h6 class="mb-0">{{shopData.orders}}</h6>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Orders</h6>
                    </div>
                </div>
            </div>       
        </div>
        <div class="my-3">
            <h5  class="section-title">Best seller</h5>
            <div class="ml-3 hr-section">
                <div class="mb-3 mr-3 col-md-3 col-6" v-for="(meal, index) in bestSellers" :key="index">
                    <div>
                        <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded ">
                    </div>              
                    <div class="card-title mb-0">
                        <p class="mb-0">{{meal.meal_name}}</p>
                        <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vOrdersHistory from './vOrdersHistory';
import StarRating from 'vue-star-rating';

export default {
    components: {
        vOrdersHistory,StarRating
    },

    data(){
        return {
            month: "",
            shop: {},
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            id: null,
            shopData: [],
            ratings: null,
            bestSellers: [],
        }
    },

    methods:{
        setDefaults(){
            if (this.isLoggedIn){
                let user = JSON.parse(localStorage.getItem('eatly.user'))
                this.id = user.id 
            }
        },

        change(){
            this.isLoggedIn = localStorage.getItem('eatly.jwt') != null
            this.setDefaults()
        },

        loadShopData(){
            let url__ = `http://127.0.0.1:8000/api/v1/shop/shop-props?user_id=${this.$store.state.id}&month=${this.month}`
            axios.get(url__).then(response => this.shopData = response.data.data) 
        }
    },

    beforeMount(){
        this.setDefaults();
    },
    
    mounted(){
        let url__1 = `http://127.0.0.1:8000/api/v1/shop/shop-props?user_id=${this.$store.state.id}&month=${this.month}`
        axios.get(url__1).then(response => {
            this.shopData = response.data.data, 
            this.month = response.data.data.month
        } ) 

        let url =  `http://127.0.0.1:8000/api/v1/shop/vendor?user_id=${this.$store.state.id}`
        axios.get(url).then(response => {
            this.shop = response.data.data

            let url_ = `http://127.0.0.1:8000/api/v1/rating/shop/?shop_name=${this.shop.shop_name}`
            axios.get(url_).then(response => this.ratings = response.data.data)

            let url1 = `http://127.0.0.1:8000/api/v1/shop/best-seller?shop_name=${this.shop.shop_name}`
            axios.get(url1).then(response => this.bestSellers = response.data.data) 
            }
        )  

                

       
        
    },
}
</script>

<style>
    .sr-card{
        border: 1px solid #A98402;
        box-sizing: border-box;
        border-radius: 8px;
        color: #A98402;
    }
    .si-card{
        border: 1px solid #A98402;
        box-sizing: border-box;
        border-radius: 8px;
        color: #A98402;
        background: #FEE280;

    }

    .shop_name{
        text-align: center;
        color: #DDA30E;
    }
    .month-input{
        width: 200px;
        display: flex;
        float: right;
    }
</style>