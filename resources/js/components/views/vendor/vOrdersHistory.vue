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
            <tr v-for="(datas, index) in data" :key="index">
                <td>{{datas.id}}</td>
                <td>{{datas.created_at}}</td>
                <td>{{datas.meal}}</td>
                <td>{{datas.name}}</td>
                <td v-if="datas.is_delivered == 0">Undelivered</td>
                <td>NGN{{datas.amount}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    props: ['oOrders'],
    computed:{
        data: function(){
            if (this.oOrders != null){
                return this.oOrders
            }
        }
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