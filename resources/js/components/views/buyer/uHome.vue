<template>
    <div class="">
        <div class="row my-3">
            <div class="col-md-6 col-6">
                <div class="home-card-1 p-3">
                    <p>35% off your first five meal orders</p>
                    <p>Start ordering now</p>
                    <button class="btn btn-theme-dark text-white">Get started</button>
                </div>                                                           
            </div>
            <div class="col-md-6 col-6">
                <div class="home-card-2 p-3">    
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>Get ₦1,000 cash discount</p>
                        </div>
                         <div>
                            <i class="bi bi-megaphone" style="font-size: 50px"></i>
                        </div>
                    </div>               
                    <div> 
                        <p><b>Refer a friend</b></p>                       
                        <button class="btn btn-theme-dark text-white">Get referral link</button>
                    </div>  
                                     
                </div>                                
            </div>
        </div>                       
        <div class="">
            <div class="mb-5">
                <h5 class="section-title">Categories</h5>
                <div class="hr-section mx-3">
                    <div v-for="(category, index) in categories" :key="index" class="col-md-2">
                        <div class="category-card p-1 text-center">
                            <router-link :to="{ path: '/category/'+category.title}">
                                <p class="category-title mb-0">{{category.title}}</p>
                            </router-link> 
                        </div>
                    </div>
                    <div class="category-card text-center px-1">
                        <router-link to="/">
                            <h6 class="category-title p-1 mb-0">More categories</h6>
                        </router-link> 
                    </div>
                </div>
            </div>
            <div class="alert alert-secondary text-center mb-0" role="alert" v-if="message != null">
                <p>{{message}}</p>
            </div> 
            <div class="alert alert-success text-center mb-0" role="alert" v-if="$store.state.message != null">
                <p>{{$store.state.message}}</p>
            </div> 
            <div class="mb-5">
                <div v-if="errored">
                    <p>This info isnt available rn</p>
                </div>
                <div v-else>
                    <div v-if="loading">
                        <vue-simple-spinner size="small" line-fg-color="#A98402"></vue-simple-spinner>
                    </div>
                    <h5 class="section-title">Top meals</h5>
                    <div class="ml-3 hr-section mb-3 positioner">
                        <div class="positioner-btn-l">
                            <button id="scroll-btn-left" class="hide btn" @click="swipeLeft">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm10.5 10a.5.5 0 0 1-.832.374l-4.5-4a.5.5 0 0 1 0-.748l4.5-4A.5.5 0 0 1 10.5 4v8z"/>
                                </svg>
                            </button>
                        </div>
                        <div class=" hr-section-inner" ref="content">
                            <div class="mb-3 mr-3 col-md-3 col-6 d-inline-block" v-for="(meal, index) in meals" :key="index">
                                <div class="image-section">
                                    <div>
                                        <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded">
                                    </div>
                                    <div class="image-overlay">
                                        <button @click="favMeal(meal)" class="image-overlay-icon">
                                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart-fill image-overlay-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>              
                                <div class="mb-0">
                                    <router-link :to="{ path: 'listings/'+meal.meal_slug}">
                                        <p class="mb-0">{{meal.meal_name}}</p>
                                    </router-link> 
                                    <router-link :to="{ path: 'shop/'+meal.shop_name}">
                                        <p class="mb-0 shop-title" style="font-weight: 200;">{{meal.shop_name}}</p>
                                    </router-link> 
                                    <p class="mb-0"><b>NG₦ {{meal.meal_price}}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="positioner-btn-r">
                            <button id="scroll-btn-right" class="hide btn" @click="swipeRight">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
                                </svg>
                            </button>
                        </div>    
                    </div>
                </div>
            </div> 
            <div class="mb-5">
                <h5 class="section-title">Based on favourite meals</h5>
                    <div class="ml-3 hr-section mb-3 positioner">
                        <div class="positioner-btn-l">
                            <button id="scroll-btn-left" class="hide btn" @click="swipeLeft">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm10.5 10a.5.5 0 0 1-.832.374l-4.5-4a.5.5 0 0 1 0-.748l4.5-4A.5.5 0 0 1 10.5 4v8z"/>
                                </svg>
                            </button>
                        </div>
                        <div class=" hr-section-inner" ref="content">
                            <div class="mb-3 mr-3 col-md-3 col-6 d-inline-block" v-for="(meal, index) in favMeals" :key="index">
                                <div class="image-section">
                                    <div>
                                        <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded">
                                    </div>
                                    <div class="image-overlay">
                                        <button @click="favMeal(meal)" class="image-overlay-icon">
                                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart-fill image-overlay-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>              
                                <div class="mb-0">
                                    <router-link :to="{ path: 'listings/'+meal.meal_slug}">
                                        <p class="mb-0">{{meal.meal_name}}</p>
                                    </router-link> 
                                    <router-link :to="{ path: 'shop/'+meal.shop_name}">
                                        <p class="mb-0 shop-title" style="font-weight: 200;">{{meal.shop_name}}</p>
                                    </router-link> 
                                    <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="positioner-btn-r">
                            <button id="scroll-btn-right" class="hide btn" @click="swipeRight">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
                                </svg>
                            </button>
                        </div>    
                    </div>
                
            </div>    
            <div class="mb-5">
                <h5 class="section-title">Based on favourite shop meals</h5>
                    <div class="ml-3 hr-section mb-3 positioner">
                        <div class="positioner-btn-l">
                            <button id="scroll-btn-left" class="hide btn" @click="swipeLeft">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm10.5 10a.5.5 0 0 1-.832.374l-4.5-4a.5.5 0 0 1 0-.748l4.5-4A.5.5 0 0 1 10.5 4v8z"/>
                                </svg>
                            </button>
                        </div>
                        <div class=" hr-section-inner" ref="content">
                            <div class="mb-3 mr-3 col-md-3 col-6 d-inline-block" v-for="(meal, index) in favShopMeals" :key="index">
                                <div class="image-section">
                                    <div>
                                        <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded">
                                    </div>
                                    <div class="image-overlay">
                                        <button @click="favMeal(meal)" class="image-overlay-icon">
                                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart-fill image-overlay-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>              
                                <div class="mb-0">
                                    <router-link :to="{ path: 'listings/'+meal.meal_slug}">
                                        <p class="mb-0">{{meal.meal_name}}</p>
                                    </router-link> 
                                    <router-link :to="{ path: 'shop/'+meal.shop_name}">
                                        <p class="mb-0 shop-title" style="font-weight: 200;">{{meal.shop_name}}</p>
                                    </router-link> 
                                    <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="positioner-btn-r">
                            <button id="scroll-btn-right" class="hide btn" @click="swipeRight">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
                                </svg>
                            </button>
                        </div>    
                    </div>
                
            </div>           
        </div>
    </div>
</template>
<script> 
import Spinner from 'vue-simple-spinner'
export default {
    components: {'vue-simple-spinner':Spinner},
    data(){
        return{
            meals: [],
            categories: [],
            favMeals: [],
            favShopMeals: [],
            loading: true,
            errored: false,
            message: null,
        }
    },

    methods:{
        scrollTo(element, scrollPixels, duration) {
            const scrollPos = element.scrollLeft;
            // Condition to check if scrolling is required
            if ( !( (scrollPos === 0 || scrollPixels > 0) && (element.clientWidth + scrollPos === element.scrollWidth || scrollPixels < 0))) {
                // Get the start timestamp
                const startTime =
                "now" in window.performance
                    ? performance.now()
                    : new Date().getTime();
                
                function scroll(timestamp) {
                    //Calculate the timeelapsed
                    const timeElapsed = timestamp - startTime;
                    //Calculate progress 
                    const progress = Math.min(timeElapsed / duration, 1);
                    //Set the scrolleft
                    element.scrollLeft = scrollPos + scrollPixels * progress;
                    //Check if elapsed time is less then duration then call the requestAnimation, otherwise exit
                    if (timeElapsed < duration) {
                        //Request for animation
                        window.requestAnimationFrame(scroll);
                    } else {
                        return;
                    }
                }
                //Call requestAnimationFrame on scroll function first time
                window.requestAnimationFrame(scroll);
            }
        },

        swipeLeft() {
            const content = this.$refs.content;
            this.scrollTo(content, -300, 800);
        },

        swipeRight() {
            const content = this.$refs.content;
            this.scrollTo(content, 300, 800);
        },

        favMeal(meal){
            let meal_id = meal.id
            let id = this.$store.state.id

            axios.post(`http://127.0.0.1:8000/api/v1/favourite/meal?user_id=${id}&meal_id=${meal_id}`)
            .then(response => {
                this.message = response.data.message
                setTimeout(() => {
                    this.message = null;
                }, 3000);
            })
        }, 
    },

    mounted(){
        //axios.get("api/meals").then(response => this.meals = response.data)
       /// .catch(error => {console.log(error)
      //  this.errored = true})
       // .finally(() => this.loading = false)

      //  axios.get("api/shops").then(response => this.shops = response.data)
      //  .catch(error => {console.log(error)
       // this.errored = true})
       // .finally(() => this.loading = false)

        axios.get('http://127.0.0.1:8000/api/v1/category/top-category')
        .then(response => this.categories = response.data.data)

        axios.get('http://127.0.0.1:8000/api/v1/order/top-meals')
        .then(response => this.meals = response.data.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)

        axios.get(`http://127.0.0.1:8000/api/v1/meal/recommended/fav/meal?user_id=${this.$store.state.id}`)
        .then(response => this.favMeals = response.data.data)

        axios.get(`http://127.0.0.1:8000/api/v1/meal/recommended/fav/vendor/meal?user_id=${this.$store.state.id}`)
        .then(response => this.favShopMeals = response.data.data)

        //this.$store.dispatch('fetchBookmarkMeal', this.$store.state.id)
    },
}
</script>
<style scoped>
    .positioner{
        position: relative;
    }

    .positioner-btn-l{
        position:absolute;
        top: 30%;
        z-index: 1;
        left: 0;
    }
    .positioner-btn-r{
        position:absolute;
        top: 30%;
        z-index: 1;
        right: 0;
    }

    .home-card-1{
        background-color: #fee280;
        border-radius: 8px;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
        justify-content: center;
        display: flex;
        align-items: center;
        flex-direction: column;
        color: #a98402;
    }
     .home-card-2{
        background-color: #fee280;
        border-radius: 8px;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
        color: #a98402;
    }
    .section-title{
        font-weight: normal;
    }
    .hr-section{
        display: flex;
        flex-direction: row;
    }
    .hr-section-inner{
        overflow: auto;
        white-space: nowrap;
        width: 100%;
    }
    .hr-section-inner::-webkit-scrollbar{
        display: none;
    }
    .category-title{
        font-weight:600;
        white-space: nowrap;
        color: #a98402;
    }
    .shop-title{
        color: #A98402;
    }
    .category-card{
        border-radius: 8px;
        background-color:#fee280;
    }
    .category-card:hover{
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
    }

    .btn-theme-dark{
        background-color: #a98402;
    }

    .image-section{
        width: 160px;
        height: 160px;
        position: relative;
    }

    .image-overlay{
        position: absolute;
        width: 160px;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        opacity: 0;
        background-color: #000;
        transition: .3s ease;
    }
    .image-section:hover .image-overlay{
        opacity: 0.3;
    }

    .image-overlay-icon {
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }


    @media only screen and (min-width: 768px) {
        .hide{
            display: block;
        }
        .search-bar{
            display: none;
        }
    }

</style>