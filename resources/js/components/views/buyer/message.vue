<template>
    <div class="">
        <div class="mb-3">
            <form action="" class="mb-3 d-flex ml-1">
                <input type="text" width="500px" class="form-control" placeholder="Search message">
                <button class="btn mx-1 border-dark">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                </button>
                <button class="btn">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="mb-3" v-for="(user, index) in users" :key="index">
            <div class="d-flex">
                <div class="mr-3">
                <!--    <img :src="require('../../../../../public/images/' +user.image+ '.png')" alt="" width="45px" class="user_image">-->
                </div>
                <div>
                    <p><b>{{user.name}}</b></p>   
                </div>
            </div><hr>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            users: [
                {
                    name: 'Ade',
                    image: 'Flower'
                },
                {
                    name: 'Eunice',
                    image: 'Cup'
                },
                {
                    name: 'Zainab',
                    image: 'chair'
                },
                {
                    name: 'Emmanuel',
                    image: 'lamp'
                },
                {
                    name: 'Ore',
                    image: 'card'
                },
            ]
        }
    }
}
</script>

<style scoped>
    .user_image{
        border-radius: 50%;
        border: 2px black solid;
        padding: 3px;
        height: 45px;
    }
</style>