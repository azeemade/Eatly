<template>
    <div>
        <div class="modal fade right edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModal">
            <div class="modal-dialog">
                <div class="modal-content">  
                    <div class="modal-header">
                        <button type="button" class="close back-btn float-left p-0 m-0" data-dismiss="modal">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg>
                        </button>
                        <p class="text-center">Edit {{selectedmeal.meal_name}}</p>
                    </div> 
                    <div class="modal-body">
                        <div class="m-3">
                            <div class="mb-2">
                                <image-upload :image="'/images/meal/'+ selectedmeal.primary_image"  class="justify-content-center d-flex" :editingMode="true"/>
                            </div>
                            <div class="mb-2">
                                <p>MEAL NAME:</p>
                                <input type="text" class="form-control border-bottom-input mr-2" v-model="selectedmeal.meal_name">
                            </div> 
                            <div class="mb-2">
                                <p>ADDITIONAL TEXT:</p>
                                <textarea name="" id="" cols="30" rows="5" class="form-control  border-bottom-input mr-2"  v-model="selectedmeal.additional_text"></textarea>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between mb-2" v-for="(size, index) in selectedmeal_size" :key="index">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-text text-size"  id="inputGroup-sizing-sm">MEAL SIZE</span>
                                        <input type="text" class="form-control mr-2 text-size" v-model="size.meal_size">
                                    </div>
                                    <div class="input-group input-group-md">
                                        <span class="input-group-text text-size" id="basic-addon1">MEAL PRICE</span>
                                        <input type="text" class="form-control mr-2 text-size" v-model="size.meal_price">
                                    </div>
                                    <span class="d-flex input-group-btn align-items-center">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  @click="remove(index)" v-show="index || (!index && selectedmeal_size.length >1)">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  @click="add(index)" v-show="index == selectedmeal_size.length-1">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>      
                                    </span>
                                </div>                         
                            </div>
                            <div class="mb-2">
                                <p>CATEGORIES:</p>
                                <div>
                                    <span v-for="(category, index) in categories" :key="index">
                                        <input type="checkbox" name="options" class="check-options" :id="category.title+ '-option'" v-model="selected_categories" :value="category.title">
                                        <label :for="category.title+ '-option'" class="btn category-btn mr-2 mb-2">{{category.title}}</label>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <p>MEAL STATUS:</p>
                                <select name="meal_status" v-model="selectedmeal.status">
                                    <option v-for="(status, index) in status" :key="index" :value="status">{{status}}</option>
                                </select>
                            </div> 
                            <div class="mb-5"> 
                                <!--<div v-if="$store.state.selectedmeal.length > 1">
                                    <div v-for="(image, index) in selectedmeal_image" :key="index">
                                        <image-upload :image="'/images/meal/'+image.url" />
                                    </div>
                                </div>
                                <div v-else>
                                    <div v-html="imageUpload"></div>
                                </div>-->
                                <multiple-image :editingMode="true" :imageList="selectedmeal_image" />
                            </div>   
                        </div>
                    </div>                                                                             
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import imageUpload from '../assets/image-upload.vue';
import MultipleImage from '../assets/multiple-image.vue';
export default {
  components: { imageUpload, MultipleImage },
    data() {
        return {
            imagePreview: null,
            showPreview: false,
            categories:[],
            status: ['in-stock', 'out-of-stock'],
            selected: []
        }
    },
    methods: {
        add(index) {
            this.$store.commit('ADD_SIZE')
        },

        remove(index){
            this.$store.commit('REMOVE_SIZE', index)
        },
        removeCategory(index){
            this.$store.commit('REMOVE_CATEGORY', index)
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
        },
    },

    computed:{
        imageUpload(){
            var res = "";
            //var len  = 3 - this.$store.state.selectedmeal.length
            for (var i=0; i < 3; i++){
                res += `<image-upload :image='' />`
                return res;
            }
        },

        ...mapGetters(
            ['selectedmeal','selectedmeal_size','selectedmeal_image', 'selectedmeal_categories']
        ),

        selected_categories:{
            get(){
                return this.$store.getters.selectedmeal_categories
            },
            set(category){
                //this.$store.state.selected_meal.categories.push(category)
                this.selected.push(category)
            }
        }
    },
    beforeMount(){
    //    axios.get(`http://127.0.0.1:8000/api/v1/meal/edit/?meal_slug=${this.$store.state.meal_slug}`)
    //    .then(response => this.meal = response.data.data)
        axios.get(`http://127.0.0.1:8000/api/v1/category/`)
        .then(response => this.categories = response.data.data)
    },
    mounted(){
      //  this.activate
    }

}
</script>
<style>
    .modal.right .modal-dialog{
		position: fixed;
		margin: auto;
        top: 0;
		min-width: 100%;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
    }
    .modal-body{
        margin-top: 73px;
    }

    .modal-content{
        height: 100%;
        overflow-y: auto;
        border-radius: 1.5rem 0px 0px 1.5rem;
    }

    .modal-header{
        position: fixed;
        width: 100%;
        z-index: 1999;
        background-color: white;
        border-bottom: 1px solid whitesmoke;
    }
    .modal.right.fade .modal-dialog {
        right: 0px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	} 
    .check-options:checked + .category-btn{
        background-color: #a98629;
    }
    .check-options{
        display: none;
    }
    @media only screen and (min-width: 768px) {
        .modal.right .modal-dialog{
            min-width: 320px;
            top: 0;
        }
    }
</style>
