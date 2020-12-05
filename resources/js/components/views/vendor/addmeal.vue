<template>
    <div class="block">
        <p class="text-center alert alert-danger" v-bind:class="{hidden: hasError}">Please fill all the fields.</p>
        <div class="text-center alert alert-danger" v-bind:class="{hidden: newMeal}" id="qDiv">
            <p>Meal Added!</p>
            <p>Do you want to continue?</p>
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-warning" @click="closeMeal">Yes</button>
                <button class="btn btn-outline-danger"><router-link :to="{path: '/vendor/meals?pid='+id}">No</router-link></button>
            </div>
        </div>
        <form @submit.prevent="addMeal">
            <!--<img :src="require('../../../../../public/images/' +data.image+ '.png')" v-show="data.image != null">
            <input type="file" id="file" @change="attachFile">-->
            <input type="text" name="name" class="form-control mb-3" v-model="meal.name" placeholder="name">
            <input type="text" name="price" class="form-control mb-3" v-model="meal.price" placeholder="price">
            <input type="text" name="image" class="form-control mb-3" v-model="meal.image" placeholder="image">
            <button type="submit" class="btn btn-info">Add meal</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            hasError: true,
            newMeal: true,
            //attachment: null,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            id: null,
            meal: {
                name:'',
                price: '',
                image: '',
            },
        }
    },

    methods: {
        setDefaults(){
            if (this.isLoggedIn){
                let user = JSON.parse(localStorage.getItem('eatly.user'))
                this.id = user.id 
            }
        },

        change(){
            this.isLoggedIn = localStorage.getItem('eatly.jwt') != null
            this.setDefaults()
        },

        closeMeal(){
            document.getElementById('qDiv').style.display = "none";
            this.meal = {name:'', price: '', image: ''}
        },
        

      addMeal(){
            var item = this.meal;
            if (item['name'] == '' || item['price'] == '' || item['image'] == ''){
                this.hasError = false;
            }
            else {
              this.hasError = true;
              axios.post(`http://127.0.0.1:8000/api/meal/${this.id}`, item).then(response => {
                  if (console.error()){
                      this.newMeal = true
                  }
                  else{
                      this.newMeal = false
                  }
                })
            }
        }
    },

    beforeMount(){
        this.setDefaults();
    },
}
</script>
<style>
    .block{
        max-width: 300px;
        margin: 0px 300px;
    }
    .hidden{
        display: none;
    }
</style>