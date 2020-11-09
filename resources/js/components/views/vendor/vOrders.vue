<template>
    <div>
        <div class="d-flex justify-content-between">
            <div>
                New Orders
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
            <tr v-for="(norder, index) in newOrders" :key="index">
                <td>{{norder.id}}</td>
                <td>{{norder.date}}</td>
                <td>{{norder.meal}}</td>
                <td>{{norder.name}}</td>
                <td>
                    <select>
                        <option v-for="(ship, index) in shipping" :key="index">{{ship.stage}}</option>
                    </select>
                </td>
                <td>NGN{{norder.amount}}</td>
            </tr>
        </table>

        <div class="d-flex justify-content-between mt-5">
            <div>
                Old Orders
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
export default {
    props: ['pid'],
    data(){
        return{
            orders: [],
            newOrders: [
                {
                    id: 10012,
                    date: 'Oct 5, 2019',
                    meal: 'Gizdodo',
                    name: 'Ugo',
                    amount: '1,230'
                },
                {
                    id: 10029,
                    date: 'Oct 5, 2019',
                    meal: 'Yam and Egg',
                    name: 'Basirat',
                    amount: '500'
                },
                {
                   id: 10439,
                    date: 'Oct 6, 2019',
                    meal: 'Jollof rice',
                    name: 'Omolola',
                    amount: '7,000'
                },
            ],
            shipping: [
                {
                    stage: 'shipped successfully'
                },
                {
                    stage: 'shipping started'
                },
                {
                    stage: 'shipping not started'
                }
            ],
        }
    },

    mounted(){
        let orve =  `http://127.0.0.1:8000/api/ordersTable/${this.pid}`
        axios.get(orve).then(response => this.orders = response.data)
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