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
                        <!-- Star ratings-->
                        <div class="my-3 commentCard" v-for="(comment, index) in comments" :key="index">
                            <div class="row p-1">
                                <div class="col-md-3">
                                    <img :src="'/images/'+ comment.user.user_image + '.png'" alt="" width="50" height="50" style="border-radius:50%;">
                                </div>
                                <div class="col-md-9">
                                    <p><b>{{comment.user.username}}</b></p>
                                    <!--<p>{{comment.created_at}}</p>-->
                                    <p>{{comments.created_at}}</p>
                                    <p>{{comment.review}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
       ...mapGetters([
            'comments'
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
    .back-btn:hover{
        background: rgba(253, 197, 0, 0.5);
        border-radius: 50%;
        color: #A98402;
    }

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
    @media only screen and (min-width: 768px) {
        .modal.right .modal-dialog{
            min-width: 320px;
            top: 0;
        }
    }
</style>