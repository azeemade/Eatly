<template>
    <div>
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" v-bind:class="data.name">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">                                                                                
                    <div class="m-3">
                        <h2>Edit Meal</h2><hr class="my-2">
                        <!--<img :src="require('../../../../../public/images/' +image+ '.png')" v-show="image != null">
                        <input type="file" id="file" @change="attachFile">-->
                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control mb-3" v-model="data.name" required>
                        </div>
                        <div class="mb-3">
                            <label for="name">Image:</label>
                            <input type="text" name="image" class="form-control mb-3" v-model="data.image" required>
                        </div>
                        <div class="mb-3">
                            <label for="name">Price:</label>
                            <input type="text" name="price" class="form-control mb-3" v-model="data.price" required placeholder="price">
                        </div>    
                        <div class="float-right">
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
        finish(event){
            this.$emit('close', this.meal)
        }
    },

}
</script>
