<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="row">
                    <div class="col-md-6">
                        <img :src="'/images/'+ meal.image" alt="" width="300" height="300" class="rounded">
                    </div>
                    <div class="col-md-6">
                        <h3 style="font-weight: 100">{{meal.name}}</h3>
                        <h5>NG₦ {{meal.price}}</h5>
                        <div class="d-flex my-4">
                            <div>
                                <p><b>Quantity:</b></p>
                            </div>                  
                            <div>
                                <a class="btn" @click.prevent="adjust(-1)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                    </svg>
                                </a>                               
                                <input type="text" v-model="quantity" class="w-25">                                   
                                <a class="btn" @click.prevent="adjust(1)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn btn-lg btn-info btn-block" @click.prevent="addToCart(meal)">Add to cart</button>
                    </div> 
                </div>
            </div>  
        </div>
        <div class="row mt-3">
            <div class="alert alert-warning alert-dismissible text-center " role="alert" v-bind:class="{hidden: hasMeal}">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Meal already in bookmark
            </div>
            <div class="col-md-8 offset-2">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="d-flex">
                            <div class="ml-3">
                                <button class="btn" @click.prevent="bookmarkMeal(meal)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmarks" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                                        <path fill-rule="evenodd" d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="ml-3">
                                <button class="btn" data-toggle="modal" data-target=".rateModal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                    </svg><span class="badge badge-secondary ml-2">{{ratings.length}}</span>
                                </button>
                                <rate :meal="meal" />
                            </div>
                            <div class="ml-3">
                                <button class="btn" data-toggle="modal" data-target=".commentModal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                    </svg><span class="badge badge-secondary ml-2">{{comments.length}}</span>
                                </button>
                                <addComment :meal="meal" :id="id"/>
                            </div>
                            <div class="ml-3">
                                <button class="btn" type="button" id="mealOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="mealOption">
                                    <li><a href="#">Share</a></li>
                                    <li><a href="#">Report meal</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr class="my-3">
                    </div>
                </div>
            </div>   
        </div>
        <div class="row">
            <div class="col-md-6">
                <comment />
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" @click="fetchComments(pagination.prev_page_url)" class="page-item"><a class="page-link" href="#">Previous</a></li>

                        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>

                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" @click="fetchComments(pagination.next_page_url)" class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 offset-2">
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
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <h5 style="font-weight: 100">{{meal.user.username}}</h5>
                                <p>Owner of 
                                    <router-link :to="{ path: '/shop/'+meal.shop.id}">
                                        <b>{{meal.shop.ShopName}}</b>
                                    </router-link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="mt-3">
            <h5 style="font-weight: 100">Meal from this vendor</h5>
            <div class="row mt-2">
                <div class="mb-5 pr-5" v-for="(meal, index) in meals" :key="index">
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
                                        <li><a @click.prevent="bookmarkMeal(meal)" href>Add to Bookmark</a></li>
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
        </div>
    </div>
</template>
<script>
import comment from './comment.vue';
export default {
  components: { comment },
    data(){
        return{
            meal: {},
            meals:[],
            quantity: 1,
            id: null,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            cart: [],
            comments: [],
            ratings: [],
            pagination: {},
            hasMeal: true
        }
    },

     methods:{
        adjust(n){
          this.quantity += n;
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
            let id = this.id
            let quantity = this.quantity
            let found = this.$store.state.cart.find(item => item.id == meal_id);

            if (found) {
                found.pivot.quantity += quantity;
                let quantiti = found.pivot.quantity
                axios.put('http://127.0.0.1:8000/api/cart/'+meal.id, {meal_id, id, quantiti})
            } else {
            axios.post('http://127.0.0.1:8000/api/cart/'+meal.id, {meal_id, id, quantity})
            .then(response => this.$store.commit('ADD_TO_CART', {quantity, meal}))
            alert('Meal added to cart')
            }
        }, 

        bookmarkMeal(meal){
            let meal_id = this.meal.id
            let id = this.id
            let found = this.$store.state.bookmarkMeal.find(item => item.id == meal_id);

            if (found) {
                this.hasMeal = false;
            } else {
                this.hasMeal = true;
            axios.post('http://127.0.0.1:8000/api/bookmark/meal/'+meal.id, {meal_id, id})
            .then(response => this.$store.commit('ADD_TO_BOOKMARK_MEAL', {meal}))
            alert('Meal added to bookmark')
            }
        }, 

        fetchComments(page_url){
        let meal_id = this.$route.params.id
        page_url = page_url || `http://127.0.0.1:8000/api/comments?id=${meal_id}`

        axios.get(page_url)
        .then(response => {
            this.comments = response.data.data
            this.makePagination(response.data)
            })
        .then(response => this.$store.commit('FETCH_COMMENTS', this.comments))
        },

        makePagination(comments){
            let pagination = {
                current_page: comments.current_page,
                last_page: comments.last_page,
                next_page_url: comments.next_page_url,
                prev_page_url: comments.prev_page_url
            };
            this.pagination = pagination;
        }

    },

    beforeMount(){ 
        this.setDefaults();
        axios.get(`http://127.0.0.1:8000/api/meals/${this.$route.params.id}`)
        .then(response => this.meal = response.data.data)
    },

    mounted(){
        let meal_id = this.$route.params.id
        this.$store.commit('SET_MEAL_ID', meal_id);
        this.$store.dispatch('fetchBookmarkMeal', this.$store.state.id)
        this.$store.dispatch('fetchRatings', meal_id)
      //  this.$store.dispatch('fetchComments', meal_id)

        this.fetchComments();

         axios.get(`http://127.0.0.1:8000/api/ratings?id=${meal_id}`)
        .then(response => this.ratings = response.data.data.ratings)

        let url_ =  `http://127.0.0.1:8000/api/related-meals/${this.$route.params.id}`
        axios.get(url_).then(response => this.meals = response.data)
    }
}
</script>
<style>
    .collapseHover:hover{
        background-color:  rgba(32, 33, 36, 0.28);
    }
    .btn:hover{
        background-color:  rgba(32, 33, 36, 0.28);
    }
    .dropdown-menu.px-3{
        width:200px;
    }
    .border-0 {
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .card-img-top{
        width: 115px;
        height: 115px;
        border-radius: 4px;
    }
</style>