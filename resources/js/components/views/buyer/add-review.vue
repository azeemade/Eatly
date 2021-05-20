<template>
    <div>
        <div class="modal fade comment-modal right" tabindex="-1" role="dialog" aria-labelledby="comment-modal">
            <div class="modal-dialog">
                <div class="modal-content px-3">
                    <div class="modal-header">
                        <button type="button" class="close back-btn float-left p-0 m-0" data-dismiss="modal">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-5">
                            <p class="my-3 text-center"><b>Kindly rate this meal</b></p>
                            <star-rating  class="justify-content-center"
                            v-model="rating" 
                            :increment="0.5" :star-size="30">
                            </star-rating>
                        </div>
                        <div class="mb-3">
                            <p class="my-3 text-center"><b>Leave a review</b></p>
                            <textarea class="form-control mb-3" rows="3" v-model="review"></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-theme-dark text-white" @click.prevent="addReview" data-dismiss="modal">Finish</button>
                        </div>
                        <div v-if="message != null">
                            <p class="text-center alert alert-danger">{{message}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating'
export default {
   props:['order'],
   components: {
        StarRating
    },

    data(){
        return{
            rating: null,
            review: null,
            message: null,
        }
    },
    methods:{
        addReview(){
            if(this.rating == null || this.review == null){
                this.message = 'Fill all fields'
                setTimeout(() => {
                    this.message = null;
                }, 3000);
            }else{
                axios.post("http://127.0.0.1:8000/api/v1/rating/store", {
                    user_id: this.$store.state.id,
                    meal_id: this.order.meal_id,
                    points: this.rating,
                    order_id: this.order.id
                })
                .then(               
                    axios.post("http://127.0.0.1:8000/api/v1/comment/store", {
                        user_id: this.$store.state.id,
                        meal_id: this.order.meal_id,
                        review: this.review,
                        order_id: this.order.id
                    })
                    .then(response =>{
                        let message = response.data.message
                        this.$store.commit('SET_MESSAGE', message),
                        setTimeout(() => {
                            this.$store.state.message = null;
                        }, 3000);

                        this.$store.dispatch('fetchClosedOrders', this.$store.state.id)
                        }
                    )
                )
            }
        }
    }
}
</script>
<style scoped>
    .btn-theme-dark{
        background-color: #a98402;
    }
</style>