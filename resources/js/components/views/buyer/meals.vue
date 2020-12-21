<template>
    <div class="">                     
        <div class="mt-4 d-flex">
            <div class="col-md-2">
                <button class="btn btn-outline-dark">New</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-dark">Price</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-dark">Food class</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-dark">Region</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-dark">Time</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-dark">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div>
            <div v-if="errored">
                <p>This info isnt available rn</p>
            </div>
            <div v-else>
                <div v-if="loading" class="load">Eatly</div>
                    <div class="alert alert-warning alert-dismissible text-center " role="alert" v-bind:class="{hidden: hasMeal}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Meal already in bookmark
                    </div>
                    <div class="mt-3 a-row">
                    <div class="col-md-3 mb-5" v-for="(meal, index) in meals" :key="index">
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
                                                        <router-link :to="{ path: '/shop/'+meal.shop.id}">
                                                            <p>BY {{meal.shop.name}}</p>
                                                        </router-link>
                                                    </div>
                                                </div><hr>
                                                <li><a href @click.prevent="bookmarkMeal(index)">Add to bookmark</a></li>
                                                <li><a href="">Share</a></li>
                                                <li><router-link :to="{ path: '/shop/'+meal.shop.id}">
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
    </div>
</template>
<script>
export default {
    data(){
        return{
            meals: [],
            loading: true,
            errored: false,
            hasMeal: true
        }
    },

    mounted(){
        axios.get("api/meals").then(response => this.meals = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)

        this.$store.dispatch('fetchBookmarkMeal', this.$store.state.id)
    },

    methods:{
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
    }
}
</script>
<style scoped>
    .a-row{
        display: flex!important;
        flex-wrap: wrap;
    }
    .p-0 p{
        margin-bottom: 0;
    }
    .dropdown-menu.px-3{
        width:200px;
    }
    .btn.btn-outline-dark {
        font-size: 1rem;
    }
    .border-0 {
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .load {
        position: relative;
        animation-name: load;
        animation-duration: 4s;
        animation-iteration-count: infinite;
    }
    /* Standard syntax */
    @keyframes load {
        0%   {left:0px; top:0px;}
        25%  {left:712.5px; top:0px;}
        50%  {left:0px; top:0px;}
    }
    .btn.btn-outline-dark{
        font-size: 0.8rem;
    }
    .col-md-7 .card .card-body .card-title p{
        font-size: 1.3rem;
    }

</style>