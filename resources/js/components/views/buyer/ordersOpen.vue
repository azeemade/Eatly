<template>
    <div>
        <div class="alert alert-success alert-dismissible text-center" role="alert" v-if="message != null">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <p>{{message}}</p>
        </div> 
        <div v-if="oOrders.length == 0" class="no-order">
            <div>
                <svg width="7em" height="7em" viewBox="0 0 16 16" class="bi bi-list-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                </svg>
            </div>
            <div>                                   
                <p>No orders yet</p>
            </div>
        </div> 
        <div v-else class="row">
            <div class="mb-5 col-md-6" v-for="(order, index) in oOrders" :key="index">
                <div class="row order-card">
                    <div class="col-md-3 col-3">
                        <img :src="'/images/meal/'+ order.image" alt="" width="100" height="100" class="rounded order-meal-image">
                    </div>
                    <div class="col-md-4 col-5">
                        <p class="mb-0">{{order.meal_name}}</p>
                        <p class="mb-0">{{order.shop_name}}</p>
                        <p class="mb-0">NG₦ {{ order.meal_price}}</p>
                        <p class="mb-0">Quantity: {{ order.quantity }}</p>
                        <p class="mb-0"><b>NG₦ {{ (order.meal_price * order.quantity).toFixed(2) }}</b></p>
                        
                    </div>
                    <div class="col-md-5 col-4">
                        <p class="mb-0">ID: {{order.id}}</p>
                        <p>{{order.created_at}}</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="small mb-0"><i>{{order.status}}</i></p>
                            <button class="btn text-danger" @click="clear(order)" v-if="order.status == 'delivery not started'">
                                <p class="small mb-0">Cancel Order</p>
                            </button>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>  
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            message: null,
        }
    },

    methods:{
        clear(order){
            let url = `http://127.0.0.1:8000/api/v1/order/user/cancel-order?order_id=${order.id}`
            axios.delete(url)
            .then(response => this.message = response.data.message)
            .then(response =>  this.$store.commit('CANCEL_ORDER', order))
        },
    },

    computed:{
        ...mapGetters([
            'oOrders'
        ]),
    },

    
}
</script>

<style scoped>
    .no-order{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .order-meal-image{
        width: 50px;
        height: 50px;
    }
    .order-card{
        background-color: #fff;
        margin: 0 0 10px 0;
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        border-radius: 8px;
    }
    @media only screen and (min-width: 768px) {
        .order-meal-image{
            width: 100px;
            height: 100px;
        }
    }
</style>