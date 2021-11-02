<template>
    <div class="container d-block">
        <div>
            <i class="bi bi-arrow-left"></i>
        </div>
        <div class="row">
            <div class="col-md-4">
                <router-link  :to="{ path: '/search/meal/?q='+$store.state.search}" class="mb-3 d-flex btn">
                    Meal
                </router-link>
                <router-link  :to="{ path: '/search/shop/?q='+$store.state.search}" class="mb-3 d-flex btn">
                    Shop
                </router-link>
                <router-link  :to="{ path: '/search/user/?q='+$store.state.search}" class="mb-3 d-flex btn">
                    User
                </router-link>
                <router-link  :to="{ path: '/search/category/?q='+$store.state.search}" class="mb-3 d-flex btn">
                    Category
                </router-link>
            </div>
            <div class="col-md-8">
                <div v-show="$route.name === 'mealSearch'">
                    <div v-if="mealList.length > 0">
                        <div class="row">
                            <div class="mb-3 col-md-4 col-4" v-for="(meal, index) in mealList" :key="index">
                                <router-link :to="{ path: '/listings/'+meal.meal_slug}">
                                    <div>
                                        <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded meal-image">
                                    </div>
                                </router-link>                
                                <div class="card-title mb-0">
                                    <p class="mb-0">{{meal.meal_name}}</p>
                                    <p class="mb-0">{{meal.shop_name}}</p>
                                    <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center">The search keyword "{{$store.state.search}}" does not exist</p>
                    </div>
                </div>
                <div v-show="$route.name === 'shopSearch'">
                    <div v-if="shopList.length > 0">
                        <div class="row">
                            <div class="mb-3 col-md-3 col-4 justify content-center d-flex" v-for="(shop, index) in shopList" :key="index">
                                <ul>
                                    <li>
                                        <router-link :to="{ path: '/shop'+shop.shop_name}">
                                            <div>
                                                <img :src="'/images/'+ shop.image+'.jpg'" alt="" width="100" height="100" class="rounded-circle">
                                            </div>
                                        </router-link>  
                                    </li>        
                                    <li>
                                        <div class="card-title mb-0">
                                            <p class="mb-0 text-center">{{shop.shop_name}}</p>
                                        </div>
                                    </li>     
                                </ul> 
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center">The search keyword "{{$store.state.search}}" does not exist</p>
                    </div>
                </div>
                <div v-show="$route.name === 'userSearch'">
                    <div v-if="userList.length > 0">
                        <div class="row">
                            <div class="mb-3 col-md-4 col-4" v-for="(user, index) in userList" :key="index">
                                <router-link :to="{ path: '/shop'}">
                                    <div>
                                        <img :src="'/images/'+ user.user_image+'.png'" alt="" width="100" height="100" class="rounded-circle">
                                    </div>
                                </router-link>                
                                <div class="card-title mb-0">
                                    <p class="mb-0 text-center">{{user.displayName}}</p>
                                    <p class="mb-0 text-center">{{user.username}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center">The search keyword "{{$store.state.search}}" does not exist</p>
                    </div>
                </div>
                <div v-show="$route.name === 'categorySearch'">
                    <div v-if="categoryList.length > 0">
                        <div class="row">
                            <div class="mb-3 col-md-4 col-4" v-for="(category, index) in categoryList" :key="index">
                                <router-link :to="{ path: '/category/'+category.title}">
                                <p class="mb-0 text-center">{{category.title}}</p>
                                </router-link>                
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center">The search keyword "{{$store.state.search}}" does not exist</p>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="d-inline-flex">
            <button type="button" class="close my-3 float-left text-danger btn ml-3 close-search-lg" @click="closeMenu_md()"><span aria-hidden="true">&times;</span></button>
            <button type="button" class="close my-3 float-left text-danger btn ml-3 close-search" @click="closeMenu()"><span aria-hidden="true">&times;</span></button>
        </div>
        <div v-if="mealList.length > 0 || shopList.length > 0 || categoryList.length > 0 || userList.length > 0">
            <div class="d-flex justify-content-around mb-5 border-bottom py-3">
                <div>
                    <router-link :to="{ path: '/search/meal/?q='+$store.state.search}">
                        Meal
                    </router-link>
                </div>
                <div>
                    <router-link :to="{ path: '/search/shop/?q='+$store.state.search}">
                        Shop
                    </router-link>
                </div>
                <div>
                    <router-link :to="{ path: '/search/user/?q='+$store.state.search}">
                        User
                    </router-link>
                </div>
                <div>
                    <router-link :to="{ path: '/search/category/?q='+$store.state.search}">
                        Category
                    </router-link>
                </div>
            </div>

            <div v-if="$route.name === 'searchmeal'">
                <div v-bind:class="{hidden: mealList.length == 0}">
                    <p class="my-2 ">Meals</p>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-4" v-for="(meal, index) in mealList" :key="index">
                            <router-link :to="{ path: '/listings/'+meal.meal_slug}">
                                <div>
                                    <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded meal-image">
                                </div>
                            </router-link>                
                            <div class="card-title mb-0">
                                <p class="mb-0">{{meal.meal_name}}</p>
                                <p class="mb-0">{{meal.shop_name}}</p>
                                <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <div v-if="$route.name === 'searchshop'">
                <div v-bind:class="{hidden: shopList.length == 0}">
                    <p class="mt-3 mb-2">Shops</p>
                    <div class="row">
                        <div class="mb-3 col-md-3 col-4 justify content-center d-flex" v-for="(shop, index) in shopList" :key="index">
                            <ul>
                                <li>
                                    <router-link :to="{ path: '/shop'+shop.shop_name}">
                                        <div>
                                            <img :src="'/images/'+ shop.image+'.jpg'" alt="" width="100" height="100" class="rounded-circle">
                                        </div>
                                    </router-link>  
                                </li>        
                                <li>
                                    <div class="card-title mb-0">
                                        <p class="mb-0 text-center">{{shop.shop_name}}</p>
                                    </div>
                                </li>     
                            </ul> 
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="$route.name === 'searchcategory'">
                <div v-bind:class="{hidden: categoryList.length == 0}">
                    <p class="mt-3 mb-2">Category</p>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-4" v-for="(category, index) in categoryList" :key="index">
                            <router-link :to="{ path: '/category/'+category.title}">
                            <p class="mb-0 text-center">{{category.title}}</p>
                            </router-link>                
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="$route.name === 'searchuser'">
                <div v-bind:class="{hidden: userList.length == 0}">
                    <p class="mt-3 mb-2">User</p>
                    <div class="row">
                        <div class="mb-3 col-md-4 col-4" v-for="(user, index) in userList" :key="index">
                            <router-link :to="{ path: '/shop'}">
                                <div>
                                    <img :src="'/images/'+ user.user_image+'.png'" alt="" width="100" height="100" class="rounded-circle">
                                </div>
                            </router-link>                
                            <div class="card-title mb-0">
                                <p class="mb-0 text-center">{{user.displayName}}</p>
                                <p class="mb-0 text-center">{{user.username}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <p class="text-center">Invalid search keyword.</p>
        </div>-->
    </div>
</template>
<script>
export default {

    data(){
        return{
            meals: [],
            shops: [],
            categories: [],
            users:[],
        }
    },

    mounted(){
        let urlm = `/api/v1/meal/meals`
        axios.get(urlm).then(response => this.meals = response.data.data)

        let urls = `/api/v1/shop/shops`
        axios.get(urls).then(response => this.shops = response.data.data)

        let urlc = `/api/v1/category/`
        axios.get(urlc).then(response => this.categories = response.data.data)

        let urlu = `/api/v1/user/`
        axios.get(urlu).then(response => this.users = response.data.data)
    },

    methods: {
        closeMenu_md(){
            document.getElementById("search-content-md").style.display = "none";
        },
        closeMenu(){
            document.getElementById('search-content').style.display= "none";
        }
    },

    computed:{
        mealList(){
            return this.meals.filter(meal => {
                return meal.meal_name.toLowerCase().includes(this.$store.state.search.toLowerCase())
            })           
        },
        shopList(){
            return this.shops.filter(shop => {
                return shop.shop_name.toLowerCase().includes(this.$store.state.search.toLowerCase())
            })           
        },
        categoryList(){
            return this.categories.filter(category => {
                return category.title.toLowerCase().includes(this.$store.state.search.toLowerCase())
            })           
        },
        userList(){
            return this.users.filter(user => {
                return user.username.toLowerCase().includes(this.$store.state.search.toLowerCase())
            })           
        },
    }
}
</script>
<style>
    .close-search-lg{
        display: none;
    }

    @media only screen and (min-width: 768px) {
        .close-search-lg{
            display: block;
        }
        .close-search{
            display:none;
        }
    }
</style>
