<template>
    <div>
        <div class="modal fade bs-example-modal-md commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModal">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <form class="mx-3">
                        <p class="my-3 text-center"><b>Leave a comment</b></p>
                        <textarea class="form-control mb-3" rows="3" v-model="newComment"></textarea>
                        <div class="mb-3">
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-secondary" @click.prevent="comment()" data-dismiss="modal">Add comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
</template>
<script>
export default {
    props: ['id', 'meal'],

    data(){
        return{
            newComment: '',
        }
    },

     methods:{
        comment(){           
            let newComment_ = this.newComment
            let user_id = this.id
            let meal_id = this.meal.id
            axios.post('http://127.0.0.1:8000/api/comment/store', {
                id: this.meal.id, 
                user_id: this.id, 
                comment: newComment_
            }).then(response =>  this.$store.commit('ADD_TO_COMMENTS', newComment_))
            alert('Comment posted !.')
        },
    },
}
</script>