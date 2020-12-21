<template>
    <div class="">
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
        <div class="">
            <div v-if="errored">
                <p>This info isnt available rn</p>
            </div>
            <div v-else>
                <div v-if="loading" class="load"></div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span><h3>Meals</h3></span>
                        <span>
                            <router-link to="/meals">
                                View more meals
                            </router-link>
                        </span>
                    </div>
                    <div class="alert alert-warning alert-dismissible text-center " role="alert" v-bind:class="{hidden: hasMeal}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Meal already in bookmark
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="">
                            <button id="left-button" @click="swipeLeft" class="btn btn-secondary">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm10.5 10a.5.5 0 0 1-.832.374l-4.5-4a.5.5 0 0 1 0-.748l4.5-4A.5.5 0 0 1 10.5 4v8z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="my-3 content" ref="content">
                            <div class="mb-5 pr-5 d-inline-block" v-for="(meal, index) in meals" :key="index">
                                <div class="border-0 p-3 btn-section">                      
                                    <div class="card-body p-0">
                                        <router-link :to="{ path: '/meal/'+meal.id}">
                                            <div>
                                                <img :src="'/images/'+ meal.image" alt="" width="115" height="115" class="rounded">
                                            </div>
                                        
                                            <div class="card-title mb-0">
                                                <p>{{meal.name}}</p>
                                                <p>{{meal.shop.name}}</p>
                                            </div>
                                        </router-link>
                                        <div class="d-flex justify-content-between">
                                            <div class="align-self-center font-weight-bold">
                                                <p>NG₦{{meal.price}}</p>
                                            </div>
                                            <div class="action-buttons">
                                                <button class="btn btn-secondary" type="button" title="share meal">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                                                    </svg>
                                                </button>
                                                <button class="btn btn-secondary" type="button" title="Add to bookmark">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm4.5 4.5a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5V4.5z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <!--<div class="dropdown">
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
                                                            <router-link :to="{ path: '/shop/'+meal.shop.id}">
                                                                <p>BY {{meal.shop.name}}</p>
                                                            </router-link>
                                                        </div>
                                                    </div><hr>
                                                    <li><a href @click.prevent="bookmarkMeal(index)">Add to bookmark</a></li>
                                                    <li><a href="">Share</a></li>
                                                    <li>
                                                        <router-link :to="{ path: '/shop/'+meal.shop.id}">
                                                                View vendor profile
                                                        </router-link>
                                                    </li><br>
                                                    <li><a class="btn btn-outline-dark" id="close">Close</a></li>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button id="right-button" @click="swipeRight" class="btn btn-secondary">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span><h3>Shops</h3></span>
                        <span>
                            <router-link to="/shops">
                                View more shops
                            </router-link>
                        </span>
                    </div>
                    <div class="mt-3 row">
                        <div class="mb-5 px-5" v-for="(shop, index) in shops" :key="index">         
                                <div class="card-body p-0">
                                    <router-link :to="{ path: '/shop/'+shop.id}">
                                        <div>
                                            <img :src="'/images/'+ shop.image + '.jpg'" alt="" width="115" height="115"  class="rounded-circle">
                                        </div>
                                    
                                        <div class="card-title mb-0">
                                            <p class="text-center">{{shop.ShopName}}</p>
                                        </div>
                                    </router-link>
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
            shops: [],
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
        axios.get("api/meals").then(response => this.meals = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)

        axios.get("api/shops").then(response => this.shops = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)

        this.$store.dispatch('fetchBookmarkMeal', this.$store.state.id)
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
    .col-md-7 .card .card-body .card-title p{
        font-size: 1.3rem;
    }
    .content{
        width: 1000px;
        overflow: hidden;
        white-space: nowrap;
    }
    /*.btn-section div div .action-buttons .btn {
        position: absolute;
        top: 50%;
        left: 90%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        display: none
    }

    .btn-section:hover div div .action-buttons .btn{
        display: block;
    }*/

</style>