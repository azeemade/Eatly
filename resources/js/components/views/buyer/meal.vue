<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div>
                            <img class="rounded" id="expanded-img" :src="'/images/meal/'+ meal.image">
                        </div>
                        <div class="row my-3 justify-content-center">
                            <div class="col-md-4 col-4" v-for="(image, index) in images" :key="index">
                                <div class="img-btn">
                                    <img :src="'/images/meal/'+ image.url" alt="" class="rounded" @click.prevent="expand(image)">
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="meal-title">{{meal.meal_name}}</h3>
                        <div class="d-flex justify-content-between">
                            <router-link v-if="isLoggedIn" :to="{ path: '/shop/'+meal.shop_name}">
                                <h5 style="font-size:100">{{meal.shop_name}}</h5>
                            </router-link>
                            <router-link v-else :to="{ path: '/i/shop/'+meal.shop_name}">
                                <h5 style="font-size:100">{{meal.shop_name}}</h5>
                            </router-link>
                            <div class="d-flex align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                </svg>
                                    <p class="mb-0">{{meal.status}}</p>
                            </div>    
                        </div>  
                        <div class="d-flex justify-content-center mb-3">
                            <star-rating class="justify-content-center mr-1"
                                v-model="meal.rating" :read-only="true" 
                                :increment="0.5" :star-size="20">
                            </star-rating>
                            <span class="badge badge-secondary ml-2 align-self-center">{{meal.rating_count}}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <select v-model="size" id="meal_size" class="form-control" @change="loadPrice()">
                                    <option disabled value="">Select a meal size</option>
                                    <option v-for="(meal_size, index) in meal_sizes" :key="index">{{meal_size.meal_size}}</option>
                                </select>
                            </div>
                            <div>
                               <h5>NG₦ {{meal.meal_price}}</h5>
                            </div>
                        </div>                  
                        <div class="d-flex my-4 align-items-baseline">
                            <div>
                                <p><b>Quantity:</b></p>
                            </div>                  
                            <div>
                                <a class="btn" @click.prevent="adjust(-1)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                    </svg>
                                </a>                               
                                <input type="text" v-model="quantity" class="quantity-input">                                   
                                <a class="btn" @click.prevent="adjust(1)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <p><b>Additional text:</b> {{meal.additional_text}}</p>
                        <div class="d-flex align-items-end">
                            <button type="submit" class="mt-3 btn btn-lg add-to-cart-btn btn-block" @click.prevent="addToCart(meal)">Add to cart</button>
                            <div class="ml-3">
                                <button class="btn btn-outline-secondary btn-lg meal-menu-btn" type="button" data-toggle="modal" data-target="#menu-content">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="grey" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </button>
                                <div class="dropdown desktop-meal-menu">
                                    <button class="btn btn-outline-secondary btn-lg desktop-meal-menu-btn" type="button" id="meal-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="grey" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="meal-menu">
                                        <li>
                                            <button class="btn" @click="favMeal(meal)">Favourite meal</button> 
                                        </li>
                                        <li><a href class="btn">Share</a></li>
                                        <li><a href class="btn" >Report meal</a></li> 
                                    </ul>
                                </div>
                            </div>
                        </div>  
                        <div class="modal fade" id="menu-content" role="dialog" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body justify-content-around d-flex">                                      
                                        <button class="btn" @click="favMeal(meal)" data-dismiss="modal">
                                            <div class="rounded-circle meal-option-icon">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                Favourite meal
                                            </div>
                                        </button> 
                                        <button class="btn" data-dismiss="modal">
                                            <div class="rounded-circle meal-option-icon">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                Share
                                            </div>
                                        </button>
                                        <button class="btn" data-dismiss="modal">
                                            <div class="rounded-circle meal-option-icon">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-flag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                Report meal
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                    </div> 
                </div>
            </div>  
        </div>
        <div class="alert alert-secondary text-center mb-0" role="alert" v-if="message != null">
            <p>{{message}}</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <comment :meal_slug="meal.meal_slug"/>
            </div>
            <div class="col-md-4 offset-md-2 mt-3">
                <button class="btn btn-default btn-lg btn-block d-flex justify-content-between" type="button"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="height: 50px;">
                    <div>
                        <a> <p class="text-left">Meet the vendor</p></a>
                    </div>
                    <div>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </div>
                </button>
                <div class="collapse mb-3" id="collapseExample">
                    <div class="border">
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <img :src="'/images/'+ meal.vendor_image+'.png'" alt="" width="50" height="50">
                            </div>
                            <div class="col-md-9 col-9">
                                <h5 style="font-weight: 100">{{meal.vendor_name}}</h5>
                                <p>Owner of 
                                    <router-link v-if="!isLoggedIn" :to="{ path: '/i/shop/'+meal.shop_name}">
                                        <b>{{meal.shop_name}}</b>
                                    </router-link>
                                    <router-link v-if="isLoggedIn" :to="{ path: '/shop/'+meal.shop_name}">
                                        <b>{{meal.shop_name}}</b>
                                    </router-link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="mt-3">
            <h5  class="section-title">Related meals</h5>
            <div class="ml-3 hr-section">
                <div class="mb-3 mr-3 col-md-3" v-for="(meal, index) in meals" :key="index">
                    <router-link :to="{ path: meal.meal_slug}">
                        <div>
                            <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded ">
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
</template>
<script>
import comment from './comment.vue';
import StarRating from 'vue-star-rating'
export default {
  components: { comment,  StarRating },
    data(){
        return{
            meal: {},
            images: [],
            size: "",
            url: '',
            meal_sizes:[],
            meals:[],
            quantity: 1,
            id: null,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            hasError: true,
            message: null
        }
    },

     methods:{
        adjust(n){
          this.quantity += n;
        },

        expand(image){
            var expandImg = document.getElementById("expanded-img");
            this.meal.image = image.url;

            expandImg.parentElement.style.display = "block";
        },

        setDefaults(){
            if (this.isLoggedIn){
                let user = JSON.parse(localStorage.getItem('eatly.user'))
                this.id = user.id
            }
        },

        change(){
            this.isLoggedIn = localStorage.getItem('eatly.jwt') != null
        },

        addToCart(meal){
            let meal_id = this.meal.id
            let quantity = this.quantity
            let size = this.size
            
            if (this.size == '' ){
                this.hasError = false;
                this.message = 'Meal size cannot be empty'
                setTimeout(() => {
                    this.message = null;
                }, 3000);
            }else{
                this.hasError = true;

                let found = this.meal_sizes.find(item => item.meal_size == size);
                if (found){
                   // return found.id;    
                    let size_id = found.id
                    this.$store.commit('ADD_TO_CART', {quantity, meal, size_id, size})
                }
            }
        }, 

        favMeal(meal){
            let meal_id = meal.id
            let id = this.id

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

        loadPrice(){
            axios.get(`http://127.0.0.1:8000/api/v1/meal/listing/${this.$route.params.meal_slug}?meal_size=${this.size}`)
            .then((response) => {
                this.meal.meal_price = response.data.selected_size.meal_price;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        showOverlay(){
            document.getElementById('menu-content').style.display= "block";
        },
    },

    beforeMount(){ 
        this.setDefaults();
        axios.get(`http://127.0.0.1:8000/api/v1/meal/listing/${this.$route.params.meal_slug}`)
        .then(response => this.meal = response.data.data)

        axios.get(`http://127.0.0.1:8000/api/v1/meal/listing/${this.$route.params.meal_slug}`)
        .then(response => this.images = response.data.images)

        axios.get(`http://127.0.0.1:8000/api/v1/meal/listing/${this.$route.params.meal_slug}`)
        .then(response => this.meal_sizes = response.data.meal_sizes)
        
        let meal_slug = this.$route.params.meal_slug
        this.$store.commit('SET_MEAL_SLUG', meal_slug);
    },

    mounted(){
        let url_ =`http://127.0.0.1:8000/api/v1/meal/related-meals/?meal_slug=${this.$route.params.meal_slug}`
        axios.get(url_).then(response => this.meals = response.data.data)    
    },
}
</script>
<style>
    .meal-title{
        font-style: normal;
        font-weight: 500;
        font-size: 30px;
        color: #DDA30E;
    }

    .btn:hover{
        background-color:  rgba(32, 33, 36, 0.28);
    }
    .dropdown-menu.px-3{
        width:200px;
    }
    .quantity-input{
        border: none;
        border-bottom: 1px solid;
        text-align: center;
        width: 25%;
    }
    .add-to-cart-btn{
        background: rgba(253, 197, 0, 0.5);
        border-radius: 4px;
        color: #A98402;
    }
    #expanded-img{
        height: 200px;
        width: 200px;
    }
    .img-btn img{
        height: 50px;
        width: 50px;
    }
    .hide{
        display: none;
    }

    #menu-content .modal-dialog{
        position:absolute;
        bottom:0;
        margin:0;
        width:100%;
        border-radius: 20px 20px 0px 0px;
        max-width: 100%;
    }
    .desktop-meal-menu{
        display: none;
    }
    .meal-option-icon{
        background: rgba(253, 197, 0, 0.5);
        color: #A98402;
        display: inline-block;
        border-radius: 50%;
        padding: 1em 1em;
    }
    
    @media only screen and (min-width: 768px) {
        .hide{
            display: block;
        }
        .hide-m{
            display: none;
        }
        #expanded-img{
            height: 300px;
            width: 300px;
        }
        .img-btn img{
            height: 75px;
            width: 75px;
        }
        .add-to-cart-btn{
            width: 100%;
        }
        .desktop-meal-menu{
            display: block;
        }
        .meal-menu-btn{
            display: none;
        }
    }
</style>