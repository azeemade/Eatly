<template>
    <div>
        <div>
            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="display-2">Make extra cash</h1>
                            <p>Register and own your own food shop on Eatly.</p>
                            <div class="d-flex">
                                <input type="text" class="form-control w-50" placeholder="Enter your shop name">
                                <button class="btn btn-default">Get started</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img :src="'/images/delivery.png'" alt="" class="rounded float-right" height="300" width="500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6" v-for="(meal, index) in meals" :key="index">
                        <div class="row">
                            <div class="col-md-6">
                                <img :src="'/images/'+ meal.image" alt="" width="160px" height="160px" class="rounded">
                            </div>
                            <div class="col-md-6">
                                <p>{{meal.name}}</p>
                                <router-link :to="{ path: '/shop/'+meal.vendor_id}" class="btn-link">
                                    {{meal.ShopName}}
                                </router-link>
                                <p><b>NGN {{meal.price}}</b></p>
                                <router-link to="/login" class="btn btn-info">
                                    Place order
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>               
        </div>
    </div>
</template>
<style>
    .hero-image{
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        width: 1366px;
        height: 450px;
    }
    .hero-text{
        text-align: left;
        position: absolute;
        top: 50%;
        left: 30%;
        transform: translate(-50%, -50%);
        color: black;
    }
</style>

<script>
export default {
    data(){
        return{
            meals:[]
        }   
    },

    beforeMount(){
        axios.get('http://127.0.0.1:8000/api/top/meals')
        .then(response => this.meals = response.data)
    }
}
</script>