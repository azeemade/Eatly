<template>
    <div>
        <div v-if="cOrders.length == 0" class="no-order">
            <div>
                <svg width="7em" height="7em" viewBox="0 0 16 16" class="bi bi-list-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                </svg>
            </div>
            <div>                                   
                <p>No orders yet</p>
            </div>
        </div> 
        <div v-else class="mb-5">
            <div class="alert alert-secondary text-center" role="alert" v-if="$store.state.message != null">
                <p>{{$store.state.message}}</p>
            </div> 
            <div class="row">
                <div class="mb-5 col-md-6" v-for="(order, index) in cOrders" :key="index">
                    <div class="v-meal-card p-2 meal-image">                   
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <img :src="'/images/meal/'+ order.image" alt="" width="100" height="100" class="rounded order-meal-image">
                            </div>
                            <div class="col-md-4 col-5">
                                <p class="mb-0">{{order.meal_name}}</p>
                                <p class="mb-0">{{order.shop_name}}</p>
                                <p class="mb-0">NG₦ {{ order.meal_price}}</p>
                                <p class="mb-0">Quantity: {{ order.quantity }}</p>
                                <p class="mb-0"><b>NG₦ {{ ((order.meal_price.replace(",", "")) * order.quantity).toLocaleString() }}</b></p>
                            </div>
                            <div class="col-md-5 col-4">
                                <p class="mb-0">ID: {{order.id}}</p>
                                <p>{{order.updated_at}}</p>
                                <div v-if="order.hasReview == null">
                                    <button title="Meal review is required" class="btn" data-toggle="modal" data-target=".comment-modal">
                                        <i class="bi bi-chat-square-dots"></i>
                                    </button>
                                    <add-review :order="order"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>         
            </div>
            <button class="btn clear-btn btn-md btn-outline-danger" @click="clearHistory()">
                Clear history
            </button>
        </div>
    </div>  
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    methods:{
        clearHistory(){
            let found = this.$store.state.cOrders.find(item => item.hasReview == null);
            if (found){
                this.$store.commit('SET_MESSAGE', 'Meal review is required for all orders'),
                setTimeout(() => {
                    this.$store.commit('SET_MESSAGE',  null);
                }, 3000);
            }
            else{
                let url = `http://127.0.0.1:8000/api/v1/order/user/clear?user_id=${this.$store.state.id}`
                axios.delete(url)
                .then(response => {
                    this.$store.dispatch('fetchClosedOrders', this.$store.state.id)
                    
                    let message = response.data.message
                    this.$store.commit('SET_MESSAGE', message);
                    setTimeout(() => {
                        this.$store.commit('SET_MESSAGE', null);
                    }, 4000);
                })


            }
        },
    },

    computed:{
        ...mapGetters([
            'cOrders'
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
    .clear-btn{
        left: 50%;
        position: absolute;
        border-radius: 4px;
    }
    .v-meal-card{
        border: 0.5px solid #a98629;
    }
    
    @media only screen and (min-width: 768px) {
        .order-meal-image{
            width: 100px;
            height: 100px;
        }
    }
</style>