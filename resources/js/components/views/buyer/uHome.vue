<template>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <p>Good morning, Have you had your breakfast?</p>
                            </div>
                        </div>  
                    </div>                                                           
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <p>Get Snacked up</p>
                            </div>
                        </div>  
                    </div>                                
                </div>
            </div>                       
            <div>
                <div v-if="errored">
                    <p>This info isnt available rn</p>
                </div>
                <div v-else>
                    <div v-if="loading" class="load">Eatly</div>
                        <div class="mt-3 row">
                        <div class="col-md-3 mb-5" v-for="(meal, index) in meals" :key="index">
                            <div class="border-0 p-3">                      
                                <div class="card-body p-0">
                                    <router-link :to="{ path: '/meal/'+meal.id}">
                                        <div>
                                        <!--    <img :src="require('../../../../../public/images/' +meal.image+ '.png')" alt="meal image"  class="card-img-top">-->
                                        </div>
                                    
                                        <div class="card-title mb-0">
                                            <p>{{meal.name}}</p>
                                        </div>
                                    </router-link>
                                        <div class="d-flex justify-content-between">
                                            <div class="align-self-center font-weight-bold">
                                                <p>NG₦{{meal.price}}</p>
                                            </div>
                                            <div class="dropdown">
                                                <div class="btn px-0" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu px-3" aria-labelledby="dropdownMenu2">
                                                    <div class="d-flex">
                                                        <div class="mr-3">
                                                        <!--    <img :src="require('../../../../../public/images/' +meal.image+ '.png')" alt="" width="45px">-->
                                                        </div>
                                                        <div>
                                                            <p><b>{{meal.name}}</b></p>
                                                            <router-link :to="{ path: '/shop/'+meal.shop.id}">
                                                                <p>BY {{meal.shop.name}}</p>
                                                            </router-link>
                                                        </div>
                                                    </div><hr>
                                                    <li><a href="">Add to bookmark</a></li>
                                                    <li><a href="">Share</a></li>
                                                    <li><router-link :to="{ path: '/shop/'+meal.shop.id}">
                                                                View vendor profile
                                                        </router-link>
                                                    </li><br>
                                                    <li><a class="btn btn-outline-dark" id="close">Close</a></li>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
        <div class="col-md-3">
            <orderHistory />
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
        }
    },

    mounted(){
        axios.get("api/meals").then(response => this.meals = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)
    },
}
</script>
<style scoped>
    .p-0 p{
        margin-bottom: 0;
    }
    .dropdown-menu.px-3{
        width:200px;
    }
    .btn.btn-outline-dark {
        font-size: 0.8rem;
    }
    .border-0 {
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .card-img-top{
        width: 115px;
        height: 115px;
        border-radius: 4px;
    }
    .load {
        position: relative;
        animation-name: load;
        animation-duration: 4s;
        animation-iteration-count: infinite;
    }
    /* Standard syntax */
    @keyframes load {
        0%   {left:0px; top:0px;}
        25%  {left:712.5px; top:0px;}
        50%  {left:0px; top:0px;}
    }
    .btn.btn-outline-dark{
        font-size: 0.8rem;
    }
    .col-md-7 .card .card-body .card-title p{
        font-size: 1.3rem;
    }

</style>