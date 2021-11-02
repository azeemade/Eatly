<template>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-3 d-flex justify-content-center">
                <img :src="'/images/'+ shop.image + '.jpg'" alt="" width="200" height="200"  class="rounded border">
            </div>
            <div class="col-md-5">
                <h3 class="center d-flex">{{shop.shop_name}}</h3>
                <div class="mt-3 d-flex center">
                    <p class="mr-1">{{shop.sales}} sales</p> |
                    <p class="ml-1">Joined {{shop.created_at}}</p>
                </div>
                <div class="mt-3 d-flex center">
                    <p class="mr-1">{{shop.active_meals}} active meal(s)</p> |
                    <p class="ml-1">Active {{shop.last_seen}}</p>
                </div>
                <div class="mt-2 d-flex center">
                    <star-rating
                        v-model="ratings" :read-only="true" 
                        :increment="0.5" :star-size="20">
                    </star-rating>
                </div>
                <div class="mt-1 d-flex center">
                    <button type="submit" class="btn my-2 fav-shop-btn btn-md" @click="favShop">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart mr-2" fill="currentcolor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>
                        Favourite shop
                    </button>
                </div>
                <div class="alert alert-secondary text-center mb-0" role="alert" v-if="message != null">
                    <p>{{message}}</p>
                </div>
                <p><b>Bio: </b>{{shop.bio}}</p>
                <div>
                    <p><b>Opening hours:</b></p>
                    <div class="text-center">
                        <p><b>{{shop.opening_time}} to {{shop.close_time}}</b></p>
                    </div>
                </div>
            </div>  
            <div class="col-md-4 vendor-section">
                <ul>
                    <li><h5 style="font-weight:100;">Shop owner</h5></li>
                    <li>
                        <img :src="'/images/'+ shop.vendor_image + '.png'" alt="" width="100" height="100"  class="rounded-circle">
                    </li>
                    <li><p class="text-center"><b>{{shop.vendor_name}}</b></p></li>
                </ul>   
            </div>
        </div>
        <div class="mt-3">
            <h5  class="section-title">Featured meals</h5>
            <div class="ml-3 hr-section">
                <div class="mb-3 mr-3 col-md-4" v-for="(fmeal, index) in fMeals" :key="index">
                    <router-link :to="{ path: '/i/listings/'+fmeal.meal_slug}">
                        <div>
                            <img :src="'/images/meal/'+ fmeal.image" alt="" width="160" height="160" class="rounded ">
                        </div>
                    </router-link>                
                    <div class="card-title mb-0">
                        <p class="mb-0">{{fmeal.meal_name}}</p>
                        <p class="mb-0"><b>NGN {{fmeal.meal_price}}</b></p>
                    </div>
                </div>
            </div>
        </div>  

        <div class="mt-3">
            <h5  class="section-title mb-3">All meals</h5>
            <div>
                <div class="d-flex mx-1">
                    <input type="search" placeholder="Search for anything" class="form-control search-meal-bar" v-model="search">
                </div>
                <div class="justify-content-end d-flex my-3">
                    <div class="dropdown">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn">
                            <p class="mb-0"><b>Sort by: <a class="small">{{selected}}</a></b></p>
                        </button>
                        <ul class="dropdown-menu">
                            <li v-for="(sort_value, index) in sort_values" :key="index">
                                <label class="btn">
                                    <a @click="sort(sort_value)" class="small" :class="[sortBy === sort_value.id ? sortDirection: '']">{{sort_value.title}}</a>
                                </label> 
                            </li>                          
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="mb-3 col-md-4 col-6" v-for="(meal, index) in searchList || sortedMeals" :key="index">
                        <router-link :to="{ path: '/i/listings/'+meal.meal_slug}">
                            <div>
                                <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded meal-image">
                            </div>
                        </router-link>                
                        <div class="card-title mb-0">
                            <p class="mb-0">{{meal.meal_name}}</p>
                            <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="vendor-section-mobile my-3">
            <img :src="'/images/'+ shop.vendor_image + '.png'" alt="" width="50" height="50"  class="rounded-circle mr-3">
            <div class="mr-3">
                <p class="mb-0">Contact shop owner</p>
                <p class="text-center mb-0"><b>{{shop.vendor_name}}</b></p>
            </div>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
            </svg>
        </div>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating'
export default {
    components: { StarRating },
    data(){
        return{
            meals: [],
            fMeals:[],
            loading: true,
            errored: false,
            shop: {},
            selected: 'Time',
            sort_values: [
                {title: 'Rating', id: 'rating'},
                {title: 'Price', id: 'meal_price'},
                {title: 'Time', id: 'created_at'},
            ],
            sortBy: 'Time',
            sortDirection: 'asc',
            search: '',
            ratings: 0,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            message: null
        }
    },

    beforeMount(){
        let url = `/api/v1/shop/vendor/?user_id=${this.$store.state.id}`
        axios.get(url).then(response => this.shop = response.data.data)

        let url1 = `/api/v1/rating/shop/?shop_name=${this.$route.params.shop_name}`
        axios.get(url1).then(response => this.ratings = response.data.data)
    },

    mounted(){
        let urlv = `/api/v1/meal/vendor/active?shop_name=${this.$route.params.shop_name}`
        axios.get(urlv).then(response => this.meals = response.data.data)

        let url_1 = `/api/v1/order/featured-meals?shop_name=${this.$route.params.shop_name}`
        axios.get(url_1).then(response => this.fMeals = response.data.data)
    },

    methods:{
        sort(sort_value){
            this.selected = sort_value.title;
            this.sortBy = sort_value.id;

            if (sort_value.id === this.sortBy){
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            }
        },
        
        favShop(){
            let shop_id = this.shop.id
            let id = this.$store.state.id

            if (this.isLoggedIn == true){
                axios.post(`/api/v1/favourite/shop?user_id=${id}&shop_id=${shop_id}`)
                .then(response => {
                    this.message = response.data.message
                    setTimeout(() => {
                        this.message = null;
                    }, 3000);
                })
            }
            else{
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            }
        }, 
    },
    computed:{
        searchList(){
            return this.meals.filter(meal => {
                return meal.meal_name.toLowerCase().includes(this.search.toLowerCase())
            })           
        },

        sortedMeals(){
            return this.meals.sort((m1, m2) => {
                let modifier = 1;
                if (this.sortDirection === 'desc') 
                    modifier = -1;
                if (m1[this.sortBy] < m2[this.sortBy]) 
                    return -1 * modifier;
                if (m1[this.sortBy] > m2[this.sortBy]) 
                    return 1 * modifier;
                return 0;
            });
        }
  }
}
</script>

<style scoped>
    .fav-shop-btn{
        background: rgba(253, 197, 0, 0.5);
        border-radius: 4px;
        color: #A98402;
    }
    .center{
        justify-content: center;
    }

    #dLabel{
        color: #A98402;
    }

    .meal-image:hover{
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        border-radius: 8px;
    }

    .asc:after{
        content: " \25B2"
    }
    .desc:after{
        content: " \25BC"
    }
    .vendor-section{
        display: none;
    }
    .vendor-section-mobile{
        display: flex;
        justify-content: center;
        border-top: 1px solid;
        border-bottom: 1px solid;
        align-items: center;
    }

    @media only screen and (min-width: 768px) {
        .center{
            justify-content: normal;
        }
        .search-meal-bar{
            width: 50%
        }
        .vendor-section{
            justify-content: center;
            display: flex;
        }
        .vendor-section-mobile{
            display: none;
        }
    }
</style>