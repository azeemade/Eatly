<template>
    <div>
        <div class="d-flex justify-content-between">
            <div>
                Open Orders
            </div>
            <div>
                <button class="btn" id="orderbtn">Collapse</button>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Order date</th>
                <th>Meal</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Delivery status</th>
                <th>Deliver</th>
            </tr>
            <tr v-for="(norder, index) in oOrders" :key="index">
                <td>{{norder.id}}</td>
                <td>{{norder.created_at}}</td>
                <td>{{norder.meal.name}}</td>
                <td>{{norder.user.username}}</td>
                <!--<td>Address</td>
                <td>Quantity</td>-->
                <td>NGN{{norder.meal.price}}</td>
                <td v-if="norder.is_delivered == 0">Undelivered</td>
                <td v-if="norder.is_delivered == 0">
                    <button type="submit" @click="deliver(index)" class="btn btn-success">Deliver Meal</button>
                </td>
                
            </tr>
        </table>

        <div class="d-flex justify-content-between mt-5">
            <div>
                Closed Orders
            </div>
            <div>
                <button class="btn" id="orderbtn">Collapse</button>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Order date</th>
                <th>Meal</th>
                <th>Name</th>
                <th>Delivery status</th>
                <th>Amount</th>
            </tr>
            <tr v-for="(order, index) in cOrders" :key="index">
                <td>{{order.id}}</td>
                <td>{{order.created_at}}</td>
                <td>{{order.meal.name}}</td>
                <td>{{order.user.username}}</td>
                <td v-if="order.is_delivered == 1">Delivered</td>
                <td>NGN{{order.meal.price}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    props: ['pid'],
    data(){
        return{
            cOrders: [],
            oOrders: [],
        }
    },

    beforeMount(){
        let url1 =  `http://127.0.0.1:8000/api/vOpenOrders/${this.pid}`
        axios.get(url1).then(response => this.oOrders = response.data)
    },

    methods:{
        getAllMeals(){
            let url1 =  `http://127.0.0.1:8000/api/vOpenOrders/${this.pid}`
            axios.get(url1).then(response => this.oOrders = response.data)

            let url2 =  `http://127.0.0.1:8000/api/vCloseOrders/${this.pid}`
            axios.get(url2).then(response => this.cOrders = response.data)
        },
        deliver(index){
            let norder = this.oOrders[index]
            axios.put(`http://127.0.0.1:8000/api/orders/${norder.id}/delivery`)//, {user_id: norder.user.id, meal_id: norder.meal.id, vendor_id: norder.meal.vendor_id, is_delivered: true})
            .then(response => {
                this.cOrders.push(norder)
                this.$forceUpdate()
                this.getAllMeals()
            })
        }
    },

    mounted(){
        let url2 =  `http://127.0.0.1:8000/api/vCloseOrders/${this.pid}`
        axios.get(url2).then(response => this.cOrders = response.data)
    },
    
}
</script>

<style scoped>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>