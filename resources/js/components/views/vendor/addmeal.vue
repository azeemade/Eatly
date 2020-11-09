<template>
    <div class="block">
        <div class="btn">
            <router-link to="">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.5 8.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                </svg>
            </router-link>
        </div>
        <form @submit.prevent="addMeal">
            <!--<img :src="require('../../../../../public/images/' +data.image+ '.png')" v-show="data.image != null">
            <input type="file" id="file" @change="attachFile">-->
            <input type="text" name="name" class="form-control mb-3" v-model="meal.name" required placeholder="name">
            <input type="text" name="price" class="form-control mb-3" v-model="meal.price" required placeholder="price">
            <input type="text" name="image" class="form-control mb-3" v-model="meal.image" required placeholder="image">
            <button type="submit" class="btn">Add meal</button>

        </form>
    </div>
</template>

<script>
//import { mapActions } from 'vuex';
export default {
    data(){
        return{
            //attachment: null,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            id: null,
            meall:[],

            meal: {
                name:'',
                price: '',
                image: '',
                vendor_id: '',
                user_id: '',
            },
            
            //name:'',
           // price: '',
          //  image: 'meal',
          //  meal: []
        }
    },

  //  computed: {
     //   data: function(){
     //       return{
    //            name: "",
    //            price:"",
    //            image: false
    ///        }
    //    }
   // },

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
      //attachFile(event){
      //    this.attachment = event.target.files[0];
     // },
      addMesal(){
          if (this.attachment != null){
              var formData = new FormData();
              formData.append("image", this.attachment)
              let headers = {'Content-Type': 'multipart/form-data'}
              axios.post("api/upload-file", formData, {headers}).then(response =>{
                  this.meal.image = response.data
              })
          }
      },
      addMeal(){
          let name = this.meal.name
          let image = this.meal.image
          let price = this.meal.price
          let vendor_id = this.meall.vendor_id
          let user_id = this.id

          axios.post("http://127.0.0.1:8000/api/meal", {name, image, price, vendor_id, user_id}).then(response => alert('Meal Added.'))
          .catch(err => alert("Meal not added."))
         // fetch('http://127.0.0.1:8000/api/meal', {
            //  method: 'post',
            //  body: JSON.stringify(this.meal),
            //  headers: {
            //      'content-type' : 'application/json'
            //  }
         // })
         // .then(res => res.json())
         // .then(data => {
          //    this.meal.name = "";
          //    this.meal.image= "";
          ////    this.meal.price = "";
          //    this.meal.vendor_id = "";
          //    this.meal.user_id = "";
          //    alert('Meal Added');
         // }).catch(err => console.log(err));

          //axios.post("api/store", {name, image, price}).then(response => {this.meal})
      }
    },

    beforeMount(){
        this.setDefaults();
        axios.get(`http://127.0.0.1:8000/api/meals/${this.id}`).then(response => this.meall = response.data)
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