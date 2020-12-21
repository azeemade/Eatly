<template>
    <div>
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" v-bind:class="data.name">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">                                                                                
                    <div class="m-3">
                        <h2>Edit Meal</h2><hr class="my-2">
                            <!--<img :src="require(`../../../../../public/images/${data.image}`)" v-show="data.image != null" width="115" height="115">
                            <input type="file" id="file" @change="attachFile">-->
                        <!--<img :src="require('../../../../../public/images/' +image)" v-show="image != null">
                        <input type="file" id="file" @change="attachFile">-->
                        <div class="my-3">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control mb-3" v-model="data.name" required>
                        </div>
                        <div class="mb-3">
                            <label for="name">Price:</label>
                            <input type="text" name="price" class="form-control mb-3" v-model="data.price" required placeholder="price">
                        </div>    
                        <div>
                            <input type="file" id="file" @change="upload_mealImage" name="image">
                            <img v-bind:src="imagePreviewn || data.image" v-show="showPreview" width="115" height="115"/>
                        </div>
                        <div class="float-right mt-3">
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info mr-2" @click="finish" data-dismiss="modal">Update</button>          
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['meal'],
    data() {
        return {
            imagePreview: null,
            showPreview: false,
        }
    },
    computed:{
        data: function(){
            if (this.meal != null){
                return this.meal
            }
            return {
                name: "",
                image: "",
                price: "",
            }
        }
    },
    methods: {
        finish() {
            this.$emit('close', this.meal)   
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

}
</script>
