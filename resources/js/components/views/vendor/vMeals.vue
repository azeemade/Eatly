<template>
    <div>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" title="New meal" class="btn add-meal-btn">
                <router-link to="/vendor/add-meal">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> New meal
                </router-link>
            </button>
        </div>
        <div class="hr-section">
            <div class="col-md-4 col-6 mb-3 py-1">
                <div class="si-card px-2">
                    <div class="float-right">
                        <h6 class="mb-0">{{active.count}}</h6>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Active meals</h6>
                    </div>
                </div>               
            </div>
            <div class="col-md-4 col-6 mb-5 py-1">
                <div class="si-card px-2">
                    <div class="float-right">
                        <h6 class="mb-0">{{awaiting.count}}</h6>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Awaiting meals</h6>
                    </div>
                </div>               
            </div>
            <div class="col-md-4 col-6 mb-5 py-1">
                <div class="si-card px-2">
                    <div class="float-right">
                        <h6 class="mb-0">{{cancelled.count}}</h6>
                    </div>
                    <div>
                        <h6 class="mb-0 mt-5 pb-1">Cancelled meals</h6>
                    </div>
                </div>               
            </div>
        </div>
        <div class="alert alert-success alert-dismissible text-center mb-0" role="alert" v-if="message != null">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <p>{{message}}</p>
        </div>        
        <div class="dropdown mb-3 d-flex justify-content-end">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn">
                <p class="mb-0"><b>Filter: <a class="small">{{selected}}</a></b></p>
            </button>
            <ul class="dropdown-menu">
                <li v-for="(value, index) in filter_values" :key="index">
                    <label class="btn btn-block text-left">
                        <a @click="option(value)" class="small">{{value.title}}</a>
                    </label> 
                </li>                          
            </ul>
        </div>
        <div v-if="$store.state.message != null" class="alert alert-success alert-dismissible text-center" role="alert">
            <p>{{$store.state.message}}</p>
        </div>

        <div class="row mb-5">
            <div class="mb-3 col-md-4 col-12" v-for="(meal, index) in filterList" :key="index">
                <div class="v-meal-card p-2 meal-image">
                    <div class="row">
                        <div class="col-md-4 col-5">
                            <img :src="'/images/meal/'+ meal.image.url" alt="" width="100" height="100" class="rounded">
                        </div>
                        <div class="mb-0 col-md-8 col-7">
                            <div>
                                <p class="mb-0">{{meal.meal_name}}</p>
                                <p class="mb-0"><b>NGN {{meal.meal_price.meal_price}}</b></p>
                                <star-rating v-model="meal.rating" :read-only="true" 
                                    :increment="0.5" :star-size="20">
                                </star-rating>
                                <p class="mb-0">{{meal.meal_approval}}</p>
                                <p class="mb-0">{{meal.meal_status}}</p>
                                <p class="mb-0">sales: {{meal.sales}}</p>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <button type="button" title="Edit" class="btn" data-toggle="modal" data-target=".edit-modal" @click="editMeal(meal)">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </button>
                                    <editmeal />
                                </div>                               
                                <div>
                                    <button type="button" title="Reviews" class="btn" data-toggle="modal" :data-target="target" @click="reviewMeal(meal)">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </button>
                                    <v-reviews />
                                </div>
                                <div>
                                    <button type="button" title="Delete" class="btn dlt-btn" data-toggle="modal" data-target=".clearModal">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                    <div class="modal fade bs-example-modal-sm clearModal" tabindex="-1" role="dialog" aria-labelledby="clearModal">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content px-3">
                                                <div class="modal-body text-center">
                                                    <p>Are you sure you want to delete meal ?</p>
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn dlt-text" data-dismiss="modal" @click="remove(meal)">Yes</button>
                                                        <button class="btn" data-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                <div>
                                    <button type="button" title="Share" class="btn">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                        </svg>
                                    </button>
                                </div>     
                            </div>                      
                        </div>
                    </div>   
                </div>            
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
import Comment from '../buyer/comment.vue'
import editmeal from './editmeal.vue'
import VReviews from './vReviews.vue'
import StarRating from 'vue-star-rating'
export default {
  components: { editmeal, Comment, VReviews, StarRating },
    data(){
        return {
            active: [],
            awaiting: [],
            cancelled: [],
            selected: 'All',
            filter_values: [
                {title: 'All'},
                {title: 'Active'},
                {title: 'Awaiting'},
                {title: 'Cancelled'},
            ],
            message: null,
            target: '.comment-modal'
        }
    },

    methods: {
        option(value){
            this.selected =  value.title
        },

        remove(meal){
            axios.delete(`/api/v1/meal/delete?meal_id=${meal.id}`)
            .then(response => {
                this.message = response.data.message,
                this.$store.commit('REMOVE_MEAL', meal)
            })
        },

        editMeal(meal){
          //  this.$store.dispatch('fetchSale', meal)
            this.$store.dispatch('editingMeal', meal.meal_slug) 
            //this.$store.commit('SET_MEAL_SLUG', meal.meal_slug)
        },
        reviewMeal(meal){
            this.$store.dispatch('fetchComments', meal.meal_slug)
        },

    },

    mounted(){
        axios.get(`/api/v1/shop/shop-name?user_id=${this.$store.state.id}`)
        .then(response => {
            this.shop_name = response.data.data.shop_name,

            //axios.get(`/api/v1/meal/vendor?shop_name=${this.shop_name}`)
            //.then(response =>this.meals = response.data.data)
            this.$store.dispatch('fetchVendorMeals', this.shop_name), 
           
            axios.get(`/api/v1/meal/active/?shop_name=${this.shop_name}`)
            .then(response =>this.active = response.data.data)
            axios.get(`/api/v1/meal/awaiting/?shop_name=${this.shop_name}`)
            .then(response =>this.awaiting = response.data.data)
            axios.get(`/api/v1/meal/cancelled/?shop_name=${this.shop_name}`)
            .then(response =>this.cancelled = response.data.data)
        })
    },

    computed:{
        filterList(){
            if (this.selected == 'All')
                return this.vmeals
            else
                return this.vmeals.filter(meal => {
                    return meal.meal_approval.toLowerCase().includes(this.selected.toLowerCase())
                })           
        },

        ...mapGetters([
            'vmeals'
        ]),
    }
}
</script>
<style scoped>
    .dlt-btn:hover, .dlt-text:hover{
        color: red;
    }
    .add-meal-btn{
        border: 0.5px solid #a98629; 
    }
    .v-meal-card{
        border: 0.5px solid #a98629;
    }

    .card-img-top img{
        width: 115px;
        height: 115px;
        border-radius: 4px;
    }
    .border-0 {
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .d-flex .card-text {
        font-size: 0.7rem;
    }
</style>