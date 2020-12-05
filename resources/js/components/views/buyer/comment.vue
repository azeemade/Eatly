<template>
    <div>
        <div class="mb-3 commentCard" v-for="(comment, index) in $store.state.comments" :key="index">
            <div class="row">
                <div class="col-md-5">
                    <!--User Image -->
                </div>
                <div class="col-md-7">
                    <p><b>{{comment.user.username}}</b></p>
                    <p>{{comment.created_at}}</p>
                    <p>{{comment.comment}}</p>
                </div>
            </div>
        </div>  
                                 
    </div>
</template>
<script>
export default {
   // props: ['pagination']
}
</script>
<style>
    .commentCard{
        background-color: #fff;
        margin: 0 0 10px 0;
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        border-radius: 8px;
    }
</style>