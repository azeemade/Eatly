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
            <div class="container-fluid">
                <div class="mb-5">
                    <h5 class="section-title">Categories</h5>
                    <div class="hr-section ml-3">
                        <div v-for="(category, index) in categories" :key="index" class="mr-3">
                            <router-link :to="{ path: 'i/category/'+category.title}">
                                <h6 class="category-title">{{category.title}}</h6>
                            </router-link> 
                        </div>
                    </div>
                </div>
                <h5 class="section-title">Top meals</h5>
                <div class="ml-3 hr-section" ref="content">
                    <div class="mb-3 mr-3 col-md-4" v-for="(meal, index) in meals" :key="index">
                        <router-link :to="{ path: 'i/listings/'+meal.meal_slug}">
                            <div>
                                <img :src="'/images/'+ meal.image" alt="" width="160px" height="160px" class="rounded ">
                            </div>
                        </router-link>                
                        <div class="card-title mb-0">
                            <p class="mb-0">{{meal.meal_name}}</p>
                            <router-link :to="{ path: 'i/shop/'+meal.shop_name}">
                                <p class="mb-0" style="font-weight: 200;">{{meal.shop_name}}</p>
                            </router-link> 
                            <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                        </div>
                    </div>
                </div>
                <button id="scroll-btn-left" @click="swipeLeft" class="btn btn-secondary hide scroll-btn">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm10.5 10a.5.5 0 0 1-.832.374l-4.5-4a.5.5 0 0 1 0-.748l4.5-4A.5.5 0 0 1 10.5 4v8z"/>
                    </svg>
                </button>
                <button id="scroll-btn-right" @click="swipeRight" class="btn btn-secondary hide scroll-btn">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
                    </svg>
                </button>
                    
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
    .category-title{
        font-weight:100;
        white-space: nowrap
    }
    .scroll-btn{
        position: absolute;
        top: 175%;
    }
    #scroll-btn-left{
        left: 0;
    }
    #scroll-btn-right{
        right: 0;
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
            categories:[]
        }   
    },

    beforeMount(){
        axios.get('http://127.0.0.1:8000/api/v1/category/')
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
        }
    }
}
</script>