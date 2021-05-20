<template>
    <div class="container">
        <div>
            <h4 class="category-header">{{$route.params.title}}</h4>
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
        <div>
            <div class="row">
                <div class="mb-3 col-md-4 col-6" v-for="(meal, index) in sortedMeals" :key="index">
                    <router-link v-if="!isLoggedIn" :to="{ path: '/i/listings/'+meal.meal_slug}">
                        <div>
                            <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded meal-image">
                        </div>
                    </router-link>  
                     <router-link v-if="isLoggedIn" :to="{ path: '/listings/'+meal.meal_slug}">
                            <div>
                                <img :src="'/images/meal/'+ meal.image" alt="" width="160" height="160" class="rounded meal-image">
                            </div>
                        </router-link>            
                    <div class="card-title mb-0">
                        <p class="mb-0">{{meal.meal_name}}</p> 
                        <router-link v-if="!isLoggedIn" :to="{ path: '/i/shop/'+meal.shop_name}">
                            <p class="mb-0" style="font-weight: 200;">{{meal.shop_name}}</p>
                        </router-link>
                        <router-link v-if="isLoggedIn" :to="{ path: '/shop/'+meal.shop_name}">
                            <p class="mb-0" style="font-weight: 200;">{{meal.shop_name}}</p>
                        </router-link>
                        <p class="mb-0"><b>NGN {{meal.meal_price}}</b></p>
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
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            loading: true,
            errored: false,
            meals: [],
            selected: 'Time',
            sort_values: [
                {title: 'Rating', id: 'rating'},
                {title: 'Price', id: 'meal_price'},
                {title: 'Time', id: 'created_at'},
            ],
            sortBy: 'Time',
            sortDirection: 'asc',

        }
    },

    beforeMount(){
        let url = `http://127.0.0.1:8000/api/v1/category/${this.$route.params.title}/show`
        axios.get(url).then(response => this.meals = response.data.data)
    },

    mounted(){

        

        //let url_ =  `http://127.0.0.1:8000/api/mealDetails/${this.$route.params.id}`
       // axios.get(url_).then(response => this.meals = response.data)
       // .catch(error => {console.log(error)
       // this.errored = true})
        //.finally(() => this.loading = false)    
    },

    methods:{
        sort(sort_value){
            this.selected = sort_value.title;
            this.sortBy = sort_value.id;

            if (sort_value.id === this.sortBy){
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            }
        },
    },
    computed:{
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
<style>
    .category-header{
        text-align: center;
        color: #A98402;
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
</style>
