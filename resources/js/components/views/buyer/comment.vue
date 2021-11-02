<template>
    <div> 
        <div class="d-flex mt-3">
            <h6 style="font-weight:100">REVIEWS</h6>
            <span class="badge badge-secondary ml-2 align-self-center">{{comments.length}}</span>
        </div>
        <div class="my-3 commentCard" v-for="(comment, index) in comments" :key="index">
            <div class="row">
                <div class="col-md-3 col-3">
                    <img :src="'/images/'+ comment.user.user_image + '.png'" alt="" class="reviewer-image">
                </div>
                <div class="col-md-9 col-9">
                    <p><b>{{comment.user.username}}</b></p>
                    <p>{{comment.created_at}}</p>
                    <p>{{comment.review}}</p>
                </div>
            </div>
        </div> 
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" @click="fetchComments(pagination.prev_page_url)" class="page-item"><a class="page-link" href="#">Previous</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]" @click="fetchComments(pagination.next_page_url)" class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav> 
                                 
    </div>
</template>
<script>
export default {
    props: ['meal_slug'],

    data(){
        return{
            comments: [],
            pagination: {},
        }
    },

    methods:{
        fetchComments(page_url){
            page_url = page_url || `/api/v1/comment/?meal_slug=${this.$store.state.meal_slug}`

            axios.get(page_url)
            .then(response => {
                this.comments = response.data.data.data
                this.makePagination(response.data.data)
            })
        },

        makePagination(comments){
            let pagination = {
                current_page: comments.current_page,
                last_page: comments.last_page,
                next_page_url: comments.next_page_url+`&meal_slug=${this.$store.state.meal_slug}`,
                prev_page_url: comments.prev_page_url+`&meal_slug=${this.$store.state.meal_slug}`
            };
            this.pagination = pagination;
        },
    },

    mounted(){
        this.fetchComments();
    }
}
</script>
<style>
    .commentCard{
        background-color: #fff;
        margin: 0 0 10px 0;
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        border-radius: 8px;
    }
    .reviewer-image{
        height: 50px;
        width: 50px;
        border-radius:50%;
    }

    @media only screen and (min-width: 768px) {
        .reviewer-image{
            height: 115px;
            width: 115px;
    }
    }
</style>