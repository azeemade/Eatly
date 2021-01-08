<template>
    <div class="">
        <div class="row my-3">
            <div class="col-md-7 col-7">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <p>Good morning, Have you had your breakfast?</p>
                        </div>
                    </div>  
                </div>                                                           
            </div>
            <div class="col-md-5 col-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <p>Get Snacked up</p>
                        </div>
                    </div>  
                </div>                                
            </div>
        </div>                       
        <div class="">
            <div class="mb-5">
                <h5 class="section-title">Categories</h5>
                <div class="hr-section mx-3">
                    <div v-for="(category, index) in categories" :key="index" class="mr-3">
                        <router-link :to="{ path: 'i/category/'+category.title}">
                            <h6 class="category-title">{{category.title}}</h6>
                        </router-link> 
                    </div>
                </div>
            </div>
            <div>
                <div v-if="errored">
                    <p>This info isnt available rn</p>
                </div>
                <div v-else>
                    <div v-if="loading" class="load"></div>
                    <h5 class="section-title">Top meals</h5>
                    <div class="ml-3 hr-section mb-3">
                        <div>
                            <button id="scroll-btn-left" class="hide" @click="swipeLeft">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm10.5 10a.5.5 0 0 1-.832.374l-4.5-4a.5.5 0 0 1 0-.748l4.5-4A.5.5 0 0 1 10.5 4v8z"/>
                                </svg>
                            </button>
                        </div>
                        <div class=" hr-section-inner" ref="content">
                            <div class="mb-3 mr-3 col-md-3 col-6 d-inline-block" v-for="(meal, index) in meals" :key="index">
                                <router-link :to="{ path: 'i/listings/'+meal.meal_slug}">
                                    <div>
                                        <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded meal-image">
                                    </div>
                                </router-link>                
                                <div class="card-title mb-0">
                                    <p class="mb-0">{{meal.meal_name}}</p>
                                    <router-link :to="{ path: 'i/shop/'+meal.shop_name}">
                                        <p class="mb-0 shop-title" style="font-weight: 200;">{{meal.shop_name}}</p>
                                    </router-link> 
                                    <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button id="scroll-btn-right" class="hide" @click="swipeRight">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
                                </svg>
                            </button>
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
            categories: [],
            loading: true,
            errored: false,
            hasMeal: true
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

         bookmarkMeal(index){
            let meal = this.meals[index]
            let meal_id = meal.id
            let id = this.$store.state.id
            let found = this.$store.state.bookmarkMeal.find(item => item.id == meal_id);

            if (found) {
                this.hasMeal = false;
            } else {
                this.hasMeal = true;
            axios.post('http://127.0.0.1:8000/api/bookmark/meal/'+meal_id, {meal_id, id})
            .then(response => this.$store.commit('ADD_TO_BOOKMARK_MEAL', {meal}))
            alert('Meal added to bookmark')
            }
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

        axios.get('http://127.0.0.1:8000/api/v1/category/')
        .then(response => this.categories = response.data.data)

        axios.get('http://127.0.0.1:8000/api/v1/order/top-meals')
        .then(response => this.meals = response.data.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)

        //this.$store.dispatch('fetchBookmarkMeal', this.$store.state.id)
    },
}
</script>
<style scoped>
    .load {
        position: relative;
        left: 50%;
        top: 50%;
        z-index: 1;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 75px;
        height: 75px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    .col-md-7 .card{
        background-color: rgba(254, 237, 0, 0.74);
        border: none;
        border-radius: 7px;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
    }
    .col-md-5 .card{
        background-color:rgb(226, 226, 226);
        border: none;
        border-radius: 7px;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
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
    }
    .hr-section-inner::-webkit-scrollbar{
        display: none;
    }
    .category-title{
        font-weight:100;
        white-space: nowrap
    }
    .shop-title{
        color: #A98402;
    }
    /*.scroll-btn{
        position: absolute;
        cursor: pointer;
    }
    #scroll-btn-left{
        left: 0;
    }
    #scroll-btn-right{
        right: 0;
    }*/

    @media only screen and (min-width: 768px) {
        .hide{
            display: block;
        }
        .search-bar{
            display: none;
        }
    }

</style>