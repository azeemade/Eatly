<template>
    <div>
        <div>
            <div class="search-bar">
                <form action="" class="d-flex mx-1">
                    <input type="search" placeholder="Search for anything" class="form-control">
                    <button type="submit" class="btn">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="hero-title">Start selling and make extra cash</h1>
                            <p>Register and own your own food shop on Eatly and vend meal straight from your kitchen.</p>
                            <div class="d-flex">
                                <input type="text" class="form-control border-bottom-input mr-2" placeholder="Enter your shop name" v-model="shop_name">
                                <button class="btn get-started-btn" @click="checkExistence">Get started</button>
                            </div>  
                            <div class="d-flex mt-2">
                                <p class="mr-1">{{message}}</p>
                                <div v-if="message == 'shop name is available'">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-circle" fill="green" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                    </svg>
                                </div>
                                <div v-if="message == 'shop already exist'">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="red" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img :src="'/images/delivery.png'" alt="" class="rounded float-right hide" height="300" width="500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
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
                <h5 class="section-title">Top meals</h5>
                <div class="ml-3 hr-section mb-3 positioner">
                    <div class="positioner-btn-l">
                        <button id="scroll-btn-left" class="hide btn" @click="swipeLeft">
                            <i class="bi bi-caret-left-square-fill"></i>
                        </button>
                    </div>
                    <div class=" hr-section-inner" ref="content">
                        <div class="mb-3 mr-3 col-md-3 col-6 d-inline-block" v-for="(meal, index) in meals" :key="index">
                            <div class="home-image-section">
                                <div>
                                    <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded">
                                </div>
                                <div class="home-image-overlay">
                                    <button @click="favMeal(meal)" class="home-image-overlay-icon">
                                        <i class="bi bi-heart-fill home-image-overlay-icon" style="font-size: 2rem;"></i>
                                    </button>
                                </div>
                            </div>              
                            <div class="mb-0">
                                <router-link :to="{ path: 'i/listings/'+meal.meal_slug}">
                                    <p class="mb-0">{{meal.meal_name}}</p>
                                </router-link> 
                                <router-link :to="{ path: 'i/shop/'+meal.shop_name}">
                                    <p class="mb-0 shop-title" style="font-weight: 200;">{{meal.shop_name}}</p>
                                </router-link> 
                                <p class="mb-0"><b>NG₦ {{meal.meal_price}}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="positioner-btn-r">
                        <button id="scroll-btn-right" class="hide btn" @click="swipeRight">
                            <i class="bi bi-caret-right-square-fill"></i>
                        </button>
                    </div>    
                </div>
            </div>               
        </div>
    </div>
</template>
<style>
    .hero-title{
        color: #A98402;
        font-size: 3.5rem;
        font-weight: 300;
        line-height: 1.2;
    }
    .jumbotron{
        background-color: white;
    }
    .hide{
        display: none;
    }
    .get-started-btn{
        background: rgba(253, 197, 0, 0.5);
        border-radius: 4px;
        color: #A98402;
        width: 40%;
        font-size: small;
    }
    .border-bottom-input{
        border: none;
        border-bottom: 1px solid black;
        background-color: white;
    }
    .section-title{
        font-weight: normal;
    }
    .hr-section{
        display: flex;
        overflow-x: auto;
    }
    .hr-section::-webkit-scrollbar{
        display: none;
    }
    .section-title{
        font-weight: normal;
    }
    .hr-section-inner{
        overflow: auto;
        white-space: nowrap;
        width: 100%;
    }
    .hr-section-inner::-webkit-scrollbar{
        display: none;
    }
    .hr-section{
        display: flex;
        flex-direction: row;
    }
    .category-title{
        font-weight:600;
        white-space: nowrap;
        color: #a98402;
    }
    .category-card{
        border-radius: 8px;
        background-color:#fee280;
    }
    .category-card:hover{
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
    }
    #scroll-btn-left{
        left: 0;
    }
    #scroll-btn-right{
        right: 0;
    }
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

    .home-image-section{
        width: 160px;
        height: 160px;
        position: relative;
    }

    .home-image-overlay{
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
    .home-image-section:hover .home-image-overlay{
        opacity: 0.3;
    }

    .home-image-overlay-icon {
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

<script>
export default {
    data(){
        return{
            meals:[],
            shop_name: '',
            message: '',
            categories:[],
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
        }   
    },

    beforeMount(){
        axios.get('http://127.0.0.1:8000/api/v1/category/top-category')
        .then(response => this.categories = response.data.data)
        axios.get('http://127.0.0.1:8000/api/v1/order/top-meals')
        .then(response => this.meals = response.data.data)
    },

    methods:{
        scrollTo(element, scrollPixels, duration) {
            const scrollPos = element.scrollLeft;
            if ( !( (scrollPos === 0 || scrollPixels > 0) && (element.clientWidth + scrollPos === element.scrollWidth || scrollPixels < 0))) {
                const startTime =
                "now" in window.performance
                    ? performance.now()
                    : new Date().getTime();
                
                function scroll(timestamp) {
                    const timeElapsed = timestamp - startTime;
                    const progress = Math.min(timeElapsed / duration, 1);
                    element.scrollLeft = scrollPos + scrollPixels * progress;
                    if (timeElapsed < duration) {
                        window.requestAnimationFrame(scroll);
                    } else {
                        return;
                    }
                }
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

        checkExistence(){
            if (this.shop_name == ''){
                alert('Please enter a name')
            }else{
                axios.get(`http://127.0.0.1:8000/api/v1/shop/exist?shop_name=${this.shop_name}`)
                .then(response =>  this.message = response.data.message)
            }
        },
        favMeal(meal){
            let meal_id = meal.id
            let id = this.$store.state.id
            if (this.isLoggedIn == true){
                axios.post(`http://127.0.0.1:8000/api/v1/favourite/meal?user_id=${id}&meal_id=${meal_id}`)
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
    }
}
</script>