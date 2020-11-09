<template>
    <div>
        <div class="d-flex mb-5">
           <!-- <div class="d-flex ml-1">
                <img :src="require('../../../../../public/images/' +shop.image+ '.png')" alt="" height="45px" class="mr-3">
                <h4>{{shop.name}}</h4>
            </div>-->
            <div>
                <select class="form-control">
                        <option v-for="(date, index) in dates" :key="index">{{date.tim}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" v-for="(car, index) in card" :key="index">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h2>{{car.cardno}}</h2>
                        </div>
                        <div>
                            {{car.icon}}
                            <svg width="2em" height="2em" viewBox="0 0 16 16" :class="car.class" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path :d ="car.d1"/>
                                <path fill-rule="evenodd" :d="car.d2"/>
                            </svg>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{{car.name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row my-5">
            <div class="col-md-4">
                <h6>Current Balance</h6>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h6>Earning this week</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h5>NGN 25,000</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h6>Orders</h6>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h6>Orders this week</h6>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div>
                            <h5>30</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <vOrdersHistory />
        <!--<vOrdersHistory :id="order.id" :created_at="order.created_at" :name="order.name" :username="order.username" :is_delivered="order.is_delivered" :price="order.price" />-->
    </div>
</template>

<script>
import vOrdersHistory from './vOrdersHistory';
export default {
    components: {
        vOrdersHistory
    },

    data(){
        return {
           // orders: [],
            dates: [
                {
                    tim: 'January'
                },
                {
                    tim: 'February'
                },
                {
                    tim: 'March'
                },
                {
                    tim: 'April'
                },
                {
                    tim: 'May'
                },
                {
                    tim: 'June'
                },
                {
                    tim: 'July'
                },
                {
                    tim: 'This month'
                },
                {
                    tim: 'This week'
                },
                {
                    tim: 'Today'
                },                 
            ],
            shop: [],
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            id: null,
            card: [
                {
                    cardno: 2,
                    class: "bi bi-cart-x-fill",
                    d2:"M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z",
                    name: 'Undelivered orders',
                },
                {
                    cardno: 8,
                    class: "bi bi-eye-fill",
                    d1: "M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z",
                    d2: "M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z",
                    name: 'Product views',
                },
                {
                    cardno: 4,
                    class: "bi bi-people-fill",
                    d2: "M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z",
                    name: 'Subscribers',
                }
            ]
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

        ole(){
            let url =  `/api/shops/${this.id}`
            axios.get(url).then(response => this.shop = response.data)
        }
    },

    beforeMount(){
        this.setDefaults();
        this.ole();
       // let url =  `/api/shops/${this.id}`
      // axios.get(url).then(response => this.shop = response.data)
    },

  //  mounted(){
    //    let url =  `/api/ordersTable/${this.shop.id}`
     //   axios.get(url).then(response => this.orders = response.data)
   // },
}
</script>
<style>
    select.form-control{
        position: absolute;
        right: 0;
        width: 10%;
    }
</style>