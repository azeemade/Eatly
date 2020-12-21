<template>
    <div>
        <div class="my-3 commentCard" v-for="(comment, index) in $store.state.comments" :key="index">
            <div class="row p-1">
                <div class="col-md-3">
                    <img :src="require(`../../../../../public/images/${comment.user.UserImage}.png`)" alt="" width="50" height="50" style="border-radius:50%;">
                </div>
                <div class="col-md-9">
                    <p><b>{{comment.user.username}}</b></p>
                    <!--<p>{{comment.created_at}}</p>-->
                    <p>{{commentsDate}}</p>
                    <p>{{comment.comment}}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            
        }
    },

    computed:{
        //getCreated_at(){
          //  var created_at = this.$store.state.comments.created_at;
         //   var event = new Date(created_at);
         //   return this.months[event.getMonth()]+' '+event.getDay()+' '+event.getFullYear();
       // }
       ...mapGetters([
            'commentsDate'
        ])
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

    .commentCard .row .col-md-9 p{
        font-size: 0.9rem;
    }
</style>