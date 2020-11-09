<template>
    <div>
        <div class="d-flex justify-content-between">
            <div>
                Recent Orders
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
                <th>Shipping</th>
                <th>Amount</th>
            </tr>
            <tr v-for="(order, index) in orders" :key="index">
                <td>{{order.id}}</td>
                <td>{{order.created_at}}</td>
                <td>{{order.name}}</td>
                <td>{{order.username}}</td>
                <td>{{order.is_delivered}}</td>
                <td>NGN{{order.price}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
//import vDashboard from './vDashboard';

export default {
    props: ['id'],// 'created_at', 'name', 'username', 'is_delivered', 'price'],
    data(){
        return{
            orders: [],
        }
    },

    mounted(){
        let url =  `/api/ordersTable/${this.id}`
       // let url =  `/api/ordersTable/55`
        axios.get(url).then(response => this.orders = response.data)
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