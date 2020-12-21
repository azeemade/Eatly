<template>
    <div class="block">
        <div class="alert alert-danger text-center " role="alert" v-bind:class="{hidden: hasError}">
            
            Please fill all the fields.
        </div>
        <div class="alert alert-warning alert-dismissible text-center " role="alert" v-bind:class="{hidden: newMeal}">
            <p>Meal Added!</p>
            <p>Do you want to continue?</p>
            <div class="d-flex justify-content-center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">Yes</span></button>
                <button class="btn btn-outline-danger"><router-link :to="{path: '/vendor/meals?pid='+id}">No</router-link></button>
            </div>
        </div>
        <form @submit.prevent="addMeal">
            <input type="text" name="name" class="form-control mb-3" v-model="meal.name" placeholder="name">
            <input type="text" name="price" class="form-control mb-3" v-model="meal.price" placeholder="price">
            <div>
                <input type="file" id="file" @change="upload_mealImage" name="image">
                <img v-bind:src="imagePreview" v-show="showPreview" width="115" height="115"/>
            </div>
            <button type="submit" class="btn btn-info mt-3">Add meal</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            hasError: true,
            newMeal: true,
            imagePreview: null,
            showPreview: false,
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

      addMeal(){
            var item = this.meal;
            if (item['name'] == '' || item['price'] == '' || item['image'] == ''){
                this.hasError = false;
            }
            else {
              this.hasError = true;

               let headers = {'Content-Type': 'multipart/form-data'}

                let formData = new FormData();
                formData.append("image", this.meal.image);
                formData.append("name", this.meal.name);
                formData.append("price", this.meal.price);

                axios.post(`http://127.0.0.1:8000/api/meal/${this.id}`, formData, {headers})
                    .then(response => {
                                this.newMeal = false
                                this.meal = {'name': '', 'price': '', 'image':''}
                            
                        })
               // axios.post("/api/upload-file", formData, {headers}).then(response => {
                //        this.meal.image = response.data
               // });

               // axios.post(`http://127.0.0.1:8000/api/meal/${this.id}`, item).then(response => {
                  //  this.meal.reset();
                //  if (console.error()){
                 //     this.newMeal = true
                 // }
                 // else{
                 //     this.newMeal = false
                 // }
               // })
            }
        },

        upload_mealImage(event){
            this.meal.image = event.target.files[0];

            let reader  = new FileReader();

            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.meal.image ){
                if ( /\.(jpe?g|png|gif)$/i.test( this.meal.image.name ) ) {

                    console.log("here");

                    reader.readAsDataURL( this.meal.image );
                }
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