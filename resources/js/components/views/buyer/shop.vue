<template>
    <div>
        <div class="row my-3">
            <div class="col-md-3">
                <img :src="require('../../../../../public/images/' + shop.image+ '.png')" alt="" class="img-main">
            </div>
            <div class="col-md-5">
                <h4>{{shop.name}}</h4>
                <p>{{meals.length}} Active products</p>
                <button class="btn-primary btn">Subscribe</button>
            </div>
        </div>
        <div v-if="errored">
            <p>This info isnt available rn</p>
        </div>
        <div v-else>
            <div v-if="loading">Loading...</div>
            <div class="row">
                <div class="col-md-3 mb-5" v-for="(meal, index) in meals" :key="index">
                    <div class="border-0 p-3">                      
                        <div class="card-body p-0">
                            <router-link :to="{ path: '/meal/'+meal.id}">
                                <div class="card-img-top">
                                <!--    <img :src="require('../../../../../public/images/' +meal.image+ '.png')" alt="" class="card-img-top">-->
                                </div>
                            </router-link>
                            <div class="card-title mb-0">
                                <p>{{meal.name}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="card-text">
                                    <p>NG₦{{meal.price}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            meals: [],
            loading: true,
            errored: false,
            shop: []
        }
    },

    mounted(){
        let url =  `/api/shops/${this.$route.params.id}`
        axios.get(url).then(response => this.shop = response.data)
        //axios.get(`api/users/${this.$route.params.id}/shops`).then(response => this.shops = response.data)
        let url_ =  `http://127.0.0.1:8000/api/mealDetails/${this.$route.params.id}`
        axios.get(url_).then(response => this.meals = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)      
    },
}
</script>

<style scoped>
    .border-0{
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .img-main{
        width: 120px;
        height: 120px;
        border-radius: 4px;
        border: 1px solid black;
    }
    .card-img-top{
        width: 115px;
        height: 115px;
        border-radius: 4px;
    }
</style>