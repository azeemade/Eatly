<template>
    <div>
        <!--<div>
            filters
        </div>-->
        <div v-if="$store.state.bookmarkMeal.length > 0" class="row">
            <div class="mb-5 pr-5" v-for="(meal, index) in $store.state.bookmarkMeal" :key="index">
                <div class="border-0 p-3">                      
                    <div class="card-body p-0">
                        <router-link :to="{ path: '/meal/'+meal.id}">
                            <div>
                                <img :src="'/images/'+ meal.image" alt="" width="115" height="115" class="rounded">
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
                                            <img :src="'/images/'+ meal.image" alt="" width="45" class="rounded">
                                        </div>
                                        <div>
                                            <p><b>{{meal.name}}</b></p>
                                            <router-link :to="{ path: '/shop/'+meal.vendor_id}">
                                                <p>BY {{meal.ShopName}}</p>
                                            </router-link>
                                        </div>
                                    </div><hr>
                                    <li><a @click.prevent="removeMeal(meal)" href>Remove from Bookmark</a></li>
                                    <li><a href="">Share</a></li>
                                    <li>
                                        <router-link :to="{ path: '/shop/'+meal.vendor_id}">
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
        <div v-else class="navbar-dropdown">
            <a class="navbar-item">
                Bookmarked meal is empty
            </a>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        removeMeal(meal) {
           axios.delete(`http://127.0.0.1:8000/api/bookmark/meal/${meal.id}?id=${this.$store.state.id}&meal_id=${meal.id}`)
           .then(response =>  this.$store.commit('REMOVE_MEAL_BOOKMARK', {meal}))
           alert('Meal removed')
        },
    },
}
</script>
<style scoped>
    .dropdown-menu.px-3{
        width:200px;
    }
    .border-0 {
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .load {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }
    /* Standard syntax */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    .btn.btn-outline-dark{
        font-size: 0.8rem;
    }

</style>