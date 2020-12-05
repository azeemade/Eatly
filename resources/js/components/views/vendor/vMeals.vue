<template>
    <div>
        <div class="row">
            <div class="col-md-3" v-for="(car, index) in card" :key="index">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2 v-if="car.title == 'Active products'">{{meals.length}}</h2>
                            <h2 v-else>{{car.cardno}}</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{{car.title}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 my-5" v-for="(meal, index) in meals" :key="index">
                <div class="card border-0">                      
                    <div class="card-body p-3">
                        <div class="card-img-top">
                        <!--    <img :src="require('../../../../../public/images/' +meal.image+ '.png')" alt="" width="160px" height="160px">-->
                        </div>
                        <div class="card-title mb-0">
                            <h6>{{meal.name}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-text">
                                <p><b>NGN {{meal.price}}</b></p>
                            </div>
                            <!--<div class="card-text" v-for="(order, index) in orders" :key="index">>
                                <p><b>{{order.length}} sells</b></p>
                            </div>-->
                            <div>
                                <button class="btn" type="button" data-toggle="modal" :data-target="'.'+ meal.name" @click="editingMeal = meal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </button>
                                <editmeal :meal ="editingMeal" @close="endEditing" v-show="editingMeal != null"/>
                                <button class="btn" @click="deleteMeal(meal)">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                    </svg>
                                </button>
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
            meals: [],
            editingMeal: null,
            card: [
                {
                    cardno: "",
                    title: 'Active products'
                },
                {
                    cardno: 2,
                    title: 'Products awaiting approval'
                },
                {
                    cardno: 4,
                    title: 'Canceled products'
                }
            ]
        }
    },

    methods: {
        getMeals(){
            axios.get(`http://127.0.0.1:8000/api/store/${this.pid}`).then(response => this.meals = response.data)
        },

        endEditing(meal){
            this.editingMeal = null

            let index = this.meals.indexOf(meal)
            let name = meal.name
            let price = meal.price
            let image = meal.image

             axios.put(`http://127.0.0.1:8000/api/meals/${meal.id}`, {name, price, image})
             .then(response => this.meals[index] = meal)
        },

        deleteMeal(meal){
            if(confirm('Are you sure?')){
                axios.delete('http://127.0.0.1:8000/api/meals/'+ meal.id).then(response =>
                this.getMeals()
                );
            }
        }
    },

    beforeMount(){
        axios.get(`http://127.0.0.1:8000/api/store/${this.pid}`).then(response => this.meals = response.data)
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