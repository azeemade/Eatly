<template>
    <div class="block container">
        <div class="mb-3">
            <image-upload class="d-flex justify-content-center" />
        </div>
        <div>
            <div class="mb-3">
                <p>MEAL NAME:</p>
                <input type="text" class="form-control border-bottom-input mr-2" v-model="meal.meal_name">
            </div> 
            <div class="mb-3">
                <p>ADDITIONAL TEXT:</p>
                <textarea name="" id="" cols="30" rows="5" class="form-control  border-bottom-input mr-2"  v-model="meal.additional_text"></textarea>
            </div>
            <div class="mb-3">
                <div>
                    <div class="d-flex justify-content-between mb-2" v-for="(input, index) in inputs" :key="index">
                        <div class="input-group input-group-md">
                            <span class="input-group-text text-size"  id="inputGroup-sizing-sm">MEAL SIZE</span>
                            <input type="text" class="form-control mr-2 text-size" v-model="input.meal_size">
                        </div>
                        <div class="input-group input-group-md">
                            <span class="input-group-text text-size" id="basic-addon1">MEAL PRICE</span>
                            <input type="text" class="form-control mr-2 text-size" v-model="input.meal_price">
                        </div>
                        <span class="d-flex input-group-btn align-items-center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  @click="remove(index)" v-show="index || (!index && inputs.length >1)">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  @click="add(index)" v-show="index == inputs.length-1">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>      
                        </span>
                    </div>
                </div>                           
            </div>
            <div class="mb-3">
                <p>CATEGORIES:</p>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <label class="btn category-btn mr-2 mb-2" v-for="(category, index) in categories" :key="index">
                        <input type="checkbox" name="options" :id="category.title+ '-option'" v-model="selectedcategories" :value="category.title">{{category.title}}
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <p>OTHER IMAGES: <small>maximum of 3 extra images</small></p>
                <multiple-image />
            </div>
            <!--<div class="mb-3">
                <p>OTHER IMAGES: <small>maximum of 3 extra images</small></p>
                <div class="image-section">
                    <div>
                        <div>
                            <img :src="preview" width="115" height="115" onerror="arguments[0].currentTarget.style.display='none'" />
                        </div>
                    </div>
                    <div class="image-add">
                        <label for="fiile"  class="btn image-overlay-icon">
                            <input type="file" id="fiile" autocomplete="off" ref="file" @change="attachimage_" class="hidden">
                            <i class="bi bi-plus" style="font-size: xxx-large"></i>
                        </label>
                    </div>
                </div>
            </div>-->
            <div v-if="message_ != null">
                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                    <p>{{message_}}</p>
                </div>               
            </div>
             <div v-if="$store.state.message != null" class="alert alert-success alert-dismissible text-center" role="alert">
                <p>{{$store.state.message}}</p>
            </div>
            <div class="alert alert-danger text-center" role="alert" v-bind:class="{hidden: hasError}">
                Please fill all the fields.
            </div>
            <div class="my-3">
                <button class="btn btn-success" @click="addMeal()">Add meal</button>
            </div>
        </div>
        
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
import MultipleImage from '../assets/multiple-image.vue'
export default {
    data(){
        return{
            hasError: true,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            id: null,
            meal: {
                meal_name: null,
                additional_text: null
            },
            categories: [],
            selectedcategories: [],
            inputs: [
                {
                    meal_size: '',
                    meal_price: ''
                }
            ],
            message_: null,
           // image_: '',
            //preview: null
        }
    },
    components: {
        MultipleImage
    },
    computed:{
        ...mapGetters(
            ['master_image', 'images']
        )
    },
    methods: {
        /*attachimage_() {
            var files = this.$refs.file.files
            var files_ = files[0]
            this.image_ = files_
           // this.$store.commit('SET_MASTER_IMAGE', files_)
           // console.log(files_)

            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var reader = new FileReader();
            reader.onload = (e) => {
                this.preview = e.target.result;
            };

            reader.readAsDataURL(file);
        },*/
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
        add(index) {
            this.inputs.push({ meal_size: '', meal_price: ''  });
        },

        remove(index){
            this.inputs.splice(index, 1)
        },

        addMeal(){
            var meal = this.meal;
            var size = this.inputs;
            if (meal['meal_name'] == null || meal['additional_text'] == null || this.master_image == undefined ||
                size['meal_size'] == '' || size['meal_price'] == '' || this.selectedcategories.length < 1 ){
                this.hasError = false;
            }
            else {
                this.hasError = true;

                let formData = new FormData();
                formData.append("meal_name", this.meal.meal_name);
                formData.append("meal_additional_text", this.meal.additional_text);
                formData.append("shop_id", this.$store.state.shop.id);
                formData.append("user_id", this.$store.state.id);

                formData.append("sizes", JSON.stringify(this.inputs));
                

                formData.append("masterImage", this.master_image);
               // formData.append('image', this.image_);

                $.each(this.images, function(key, image){
                    formData.append(`images[${key}]`, image);
                })

                $.each(this.selectedcategories, function(key, title){
                    formData.append(`selectedcategories[${key}]`, title);
                })


                axios.post(`/api/v1/meal/meal-details/`, formData, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response => {
                        if(response.data.message === 'Meal saved successfully'){
                            this.$router.push('/vendor/meals')
                            this.$store.commit('SET_MESSAGE', response.data.message)
                            setTimeout(() => {
                                this.$store.state.message = null;
                            }, 3000);
                        }
                        else{
                            this.message_ = response.data.message 
                        }                              
                    })
            }
        },
    },

    beforeMount(){
        this.setDefaults();

        axios.get(`/api/v1/category/`)
        .then(response => this.categories = response.data.data)
    },
}
</script>
<style>
    .block{
        max-width: 450px;
    }
    .category-btn{
        white-space: nowrap;
        border: 0.5px solid #a98629;
    }
    .category-btn.active {
        background-color: #a98629;
    }
    .hidden{
        display: none;
    }
    .text-size{
            font-size: xx-small;
        }
    @media only screen and (min-width: 768px) {
        .text-size{
            font-size: medium;
        }
    }
</style>