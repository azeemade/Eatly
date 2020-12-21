<template>
    <div>
        <div class="row">
            <div class="col-md-3" v-for="(car, index) in card" :key="index">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2 v-if="car.title == 'Active meals'">{{$store.state.vMeals.length}}</h2>
                            <h2 v-else>{{car.cardno}}</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h5 class="text-center" style="font-weight: 100">{{car.title}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="alert alert-success alert-dismissible text-center " role="alert" v-bind:class="{hidden: $store.state.message}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{$store.state.message}}
        </div>-->
        <div class="row">
            <div class="col-md-3 my-5" v-for="(meal, index) in $store.state.vMeals" :key="index">
                <div class="card border-0">                      
                    <div class="card-body p-3">
                        <div class="card-img-top">
                            <img :src="'/images/'+ meal.image" alt="" width="160px" height="160px">
                        </div>
                        <div class="card-title mb-0">
                            <p>{{meal.name}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-text">
                                <p><b>NGN {{meal.price}}</b></p>
                            </div>
                            <div>
                                <button class="btn" type="button" data-toggle="modal" :data-target="'.'+ meal.name" @click="passMeal(meal)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-up-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                    </svg>
                                </button>
                                <vMeal />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['pid'],
    data(){
        return {
            card: [
                {
                    cardno: "",
                    title: 'Active meals'
                },
                {
                    cardno: 2,
                    title: 'Meals awaiting approval'
                },
                {
                    cardno: 4,
                    title: 'Canceled meals'
                }
            ]
        }
    },

    methods: {
        passMeal(meal){
            this.$store.dispatch('fetchSale', meal)
            this.$store.dispatch('fetchVRating', meal)
            this.$store.commit('SET_VENDOR_MEAL', meal)
            this.$store.dispatch('fetchComments', meal)
        },
    },

    beforeMount(){
        this.$store.dispatch('fetchVMeals', this.pid)
    },
}
</script>
<style scoped>
    .card-img-top img{
        width: 115px;
        height: 115px;
        border-radius: 4px;
    }
    .border-0 {
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
    .d-flex .card-text {
        font-size: 0.7rem;
    }
</style>