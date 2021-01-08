<template>
    <div>
        <div class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="mealLabel" v-bind:class="meal.name">
            <div class="modal-dialog">
                <div class="modal-content px-3">   
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="mealImage">
                        <img :src="'/images/'+ meal.image" alt="" width="160px" height="160px" class="rounded">
                        <div class="action-buttons">
                            <button class="btn btn-danger" type="button" title="delete meal image">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class="text-center">{{sale}} sales</p>
                        <vMealRating :rating="vRating" />
                        <div>
                            <div class="mb-4">
                                <label for="name">NAME:</label>
                                <input type="text" v-model="meal.name" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="price">PRICE:</label>
                                <input type="text" v-model="meal.price" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="quantityTYPE">QUANTITY TYPE:</label>                           
                                <div class="input-group mb-3" v-for="(input, index) in inputs" :key="index">
                                    <input type="text" v-model="input.quantityType" class="form-control">
                                    <span class="d-block input-group-btn">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  @click="remove(index)" v-show="index || (!index && inputs.length >1)">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                        </svg>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  @click="add(index)" v-show="index == inputs.length-1">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>      
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="mealStatus">MEAL STATUS:</label>
                                <select name="" class="form-control">
                                    <option disabled value="">Change meal status</option>
                                    <option v-for="(status, index) in statuss" :key="index" class="form-control">{{status.stat}}</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="price">ADD MORE MEAL IMAGES</label>
                                <div>
                                    <button class="btn pic-btn">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg> 
                                    </button>
                                </div>
                            </div>
                            <p class="text-center alert alert-danger my-2" v-bind:class="{hidden: hasError}">Please fill all the fields.</p>
                            <div class="mb-5 d-flex justify-content-between">
                                <button class="btn btn-danger" type="button" @click="deleteMeal(meal)" data-dismiss="modal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-warning" type="button" @click="editMeal(meal)" data-dismiss="modal">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-default btn-lg btn-block d-flex justify-content-between" type="button"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="height: 50px;">
                            <div>
                                <a> <p class="text-left">Reviews</p></a>
                            </div>
                            <div>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </div>
                        </button>
                        <div class="collapse mb-3" id="collapseExample">
                            <vReviews />
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
    data() {
        return{
            hasError: true,
            inputs: [
                {
                    quantityType: ''
                }
            ],

            statuss: [
                {
                    stat: 'Active'
                },
                {
                    stat: 'Cancelled'
                }
            ]
        }
    },

    computed:{
        meal(){
            return this.$store.state.vMeal
        },

        ...mapGetters([
            'sale','vRating'
        ])
    },

    methods:{
         add(index) {
            this.inputs.push({ quantityType: '' });
        },

        remove(index){
            this.inputs.splice(index, 1)
        },

        editMeal(meal){
            let name = meal.name
            let price = meal.price
            let image = meal.image

            if (name == '' || price == ''){
                this.hasError = false;
            }
            else {
              this.hasError = true;

             axios.put(`http://127.0.0.1:8000/api/meals/${meal.id}`, {name, price, image})
             .then(response => this.$store.commit('SET_MESSAGE', response.data.message))
            }
        },  

        deleteMeal(meal){
            if(confirm('Are you sure?')){
                axios.delete('http://127.0.0.1:8000/api/meals/'+ meal.id)
                .then(response => this.$store.commit('REMOVE_VENDOR_MEAL', meal))
            }
        },   
    },
}
</script>
<style scoped>
    .modal.right .modal-dialog{
		position: fixed;
		margin: auto;
		width: 320px;
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

    div.mb-4 input, .input-group.mb-3 input{
        border: none;
        border-bottom: 1px solid;
    }

    div.mb-4 label, div label{
        opacity: 1;
        font-size: smaller;
        text-align:end;
    }

    .mealImage{
        justify-content: center;
        display: flex; 
        margin-top: 1rem;
        margin-bottom: 1rem; 
    }

    .mealImage .action-buttons .btn {
        position: absolute;
        top: 50%;
        left: 90%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        display: none
    }

    .mealImage:hover .action-buttons .btn{
        display: block;
    }

    .pic-btn{
        background-color: #80808033;
        width: 75px;
        height: 75px;
    }
</style>