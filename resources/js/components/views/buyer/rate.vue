<template>
    <div>
        <div class="modal fade bs-example-modal-sm rateModal" tabindex="-1" role="dialog" aria-labelledby="rateModal">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content px-3">
                    <p class="my-3 text-center"><b>Rate this meal</b></p>
                    <div class="stars text-center">
                        <input type="radio" name="rate" id="five" value="5" v-model="rating">
                        <label for="five"></label>
                        <input type="radio" name="rate" id="four" value="4" v-model="rating">
                        <label for="four"></label>
                        <input type="radio" name="rate" id="three" value="3" v-model="rating">
                        <label for="three"></label>
                        <input type="radio" name="rate" id="two" value="2" v-model="rating">
                        <label for="two"></label>
                        <input type="radio" name="rate" id="one" value="1" v-model="rating">
                        <label for="one"></label>
                    </div>
                    <p class="text-center alert alert-danger" v-bind:class="{hidden: hasError}">Please fill all the fields.</p>
                    <p class="text-center">{{message}}</p>
                    <div class="mb-3">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" @click="addRatings" data-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['meal'],

    data(){
        return{
            rating: '',
            message: '',
            hasError: true,
        }
    },
    methods:{
        addRatings(){
            if(this.rating == ''){
                this.hasError = false;
            }else{
                this.hasError = true;
                axios.post("http://127.0.0.1:8000/api/rateMeal", {
                    user_id: this.$store.state.id,
                    id: this.meal.id,
                    points: this.rating
                })
                .then(response => this.message = response.message)
            }
        }
    }
}
</script>
<style>
    .stars{
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }
    .stars input{
        display: none;
    }

    .stars label{
        color: grey;
        text-shadow: 1px 1px #bbb; 
    }

    .stars label:before{
       content: '★';
       font-size: 50px;
    }

    .stars input:checked ~ label{
        color: gold;
        text-shadow: 1px 1px #c60;
    }

    .stars:not(:checked) >
    label:hover,
    .stars:not(:checked) >
    label:hover ~ label{
        color: gold;
        text-shadow: 1px 1px goldenrod;
    }
</style>