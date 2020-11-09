<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            <!--   <img :src="require('../../../../../public/images/' + meal.image + '.png')" alt="" width="160px">-->
            </div>
            <div class="col-md-6">
                <h2>{{meal.name}}</h2>
                <p>NG₦{{meal.price}}</p>
                <div class="d-flex">
                    <div>
                        <p>Quantity:</p>
                    </div>                  
                    <div>
                        <a class="btn" @click="adjust(-1)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                            </svg>
                        </a>
                        <a>{{ val }}</a>
                        <a class="btn" @click.prevent="adjust(1)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <button class="btn-lg" :click="addToCart(meal)">Add to cart</button>
            </div>   
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            val: 1,
            meal: '',
        }
    },

    beforeMount(){ 
        axios.get(`http://127.0.0.1:8000/api/meals/${this.$route.params.id}`).then(response => this.meal = response.data)
    },

    methods:{
        adjust(n){
          this.val += n;
        },
        addToCart(meal) {
            this.$store.commit('addToCart', meal);
        },
    }
}
</script>