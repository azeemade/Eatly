<template>
    <div>
        <div v-if="delivered.length == 0" class="no-order">
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
            <div class="row">
                <div class="mb-5 col-md-6" v-for="(order, index) in delivered" :key="index">
                    <div class="v-meal-card meal-image pl-1">
                        <div class="row">
                            <div class="col-md-3 col-3 py-1">
                                <img :src="'/images/meal/'+ order.image" alt="" width="100" height="100" class="rounded order-meal-image">
                            </div>
                            <div class="col-md-4 col-5">
                                <p class="mb-0">{{order.meal_name}}</p>
                                <p class="mb-0">Size: {{order.meal_size}}</p>
                                <p class="mb-0">NG₦ {{ order.meal_price}}</p>
                                <p class="mb-0">Qty: {{ order.quantity }}</p>
                                <p class="mb-0"><b>NG₦ {{ ((order.meal_price.replace(",", "")) * order.quantity).toLocaleString() }}</b></p>
                            </div>
                            <div class="col-md-5 col-4">
                                <p class="mb-0">ID: {{order.id}}</p>
                                <p class="small mb-0"><i>{{order.status}}</i></p>
                                <p>{{order.updated_at}}</p>
                            </div>
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

 
    computed:{
        ...mapGetters([
            'delivered'
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