<template>
    <div>
        <div v-if="orders == ``">
            <p>You've got no orders yet.</p>
        </div>
        <div v-else class="row">
            <div class="mb-5 col-md-3" v-for="(order, index) in orders" :key="index">
                <div>
                    <div>
                        <img :src="'/images/'+ order.meal.image" alt="" width="45" height="45" class="rounded">
                    </div>
                    <div>
                        <h6>{{order.meal.name}}</h6>
                        <p>Price: NG₦{{order.meal.price}}</p>
                        <p>Quantity: {{ order.quantity }}</p>
                        <p>Total: <b>NGN{{ order.meal.price * order.quantity }}</b></p>
                    </div>
                </div><hr>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-danger mt-3" @click="clear">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                        Cancel History
                    </button>
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
export default {
    data(){
        return{
            orders:[],
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            id: null,
        }
    },

    methods:{
        clear(){
            for (let meal of this.meals){
                meal.splice(0, meal)
            }
        },
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
    },

    beforeMount(){
        this.setDefaults();
        
    },
    mounted(){
         axios.get(`api/closeOrders/${this.id}`).then(response => this.orders = response.data)   
    },
    
}
</script>

<style scoped>
    .d-flex .col-md-8{
        font-size: small;
    }
</style>