<template>
    <div class="block">
        <div class="btn">
            <router-link to="">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.5 8.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                </svg>
            </router-link>
        </div>
        <form>
        <!--    <img :src="require('../../../../../public/images/' +image+ '.png')" v-show="image != null">
            <input type="file" id="file" @change="attachFile">-->
            <input type="text" name="name" class="form-control mb-3" v-model="meal.name" required placeholder="name">
        <!--    <input type="text" name="image" class="form-control" v-model="image" required v-html="require('../../../../../public/images/' +meal.image+ '.png')">-->
             <input type="text" name="image" class="form-control mb-3" v-model="meal.image" required placeholder="image">
            <input type="text" name="price" class="form-control mb-3" v-model="meal.price" required placeholder="price">
            <button type="submit" @click="submitMeal" class="btn mr-2">Submit</button>
            <button type="submit" @click="deleteMeal" class="btn">Delete</button>
        </form>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    data(){
        return{
            name:'',
            price: '',
            image: 'meal',
            meal: []
        }
    },
    methods: {
      //  ...mapActions(['addMeal']),
      //  submitMeal(e){
          //  e.preventDefault();
          //  const meal = {
          //      name: this.name,
          //      price: this.price
           // }
          //  this.addMeal(meal);
      //  }
    },
    beforeMount(){
        axios.get(`http://127.0.0.1:8000/api/meals/${this.$route.params.id}`).then(response => this.meal = response.data)
    },
    mounted:{

    }
}
</script>
<style>
    .block{
        max-width: 500px;
        margin: 0px 250px;
    }
</style>