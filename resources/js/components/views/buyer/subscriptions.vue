<template>
    <div class="block">
        <div class="hr-scroll mb-3">
            <button class="slide" type="button" @click="scroll(-20)">
                <svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                </svg>
            </button>
            <div id="content">
                <div v-for="(shop, index) in shops" :key="index" class="col-md-3">
                <!--    <div class="dropdown">
                        <div class="btn" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img :src="require('../../../../../public/images/' +shop.image+ '.png')" alt="" class="shop_image">
                        </div>    
                        <div class="dropdown-menu px-3" aria-labelledby="dropdownMenu3">
                            <li><p>{{shop.shop_name}}</p></li><br>
                            <li><a href="">Unsubscribe</a></li>
                            <li><a href="">Mute</a></li>
                            <li><router-link :to="{ path: '/shop/'}">
                                        View vendor profile
                                </router-link>
                            </li><br>
                            <li><a class="btn btn-outline-dark" id="close">Close</a></li>
                        </div>                    
                    </div>-->
                    <div class="btn" type="button" data-toggle="modal" data-target="#myModal">
                    <!--    <img :src="require('../../../../../public/images/' +shop.image+ '.png')" alt="" class="shop_image">-->
                    </div> 
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-body">
                                <li><p>{{shop.shop_name}}</p></li><br>
                                <li><a href="">Unsubscribe</a></li>
                                <li><a href="">Mute</a></li>
                                <li><router-link :to="{ path: '/shop/'}">
                                            View vendor profile
                                    </router-link>
                                </li><br>
                                <li><a class="btn btn-outline-dark" id="close">Close</a></li>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="slide" type="button" @click.prevent="scroll(20)">
                <svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
                </svg>
            </button>
        </div>
        <div class="mb-3" v-for="(meal, index) in meals" :key="index">
            <div class="d-flex">
                <router-link :to="{ path: '/meal/'}" class="d-flex col-md-11">
                    <div class="col-md-5">
                        <img :src="require('../../../../../public/images/' +meal.image+ '.png')" alt="" class="user_image">
                    </div>
                    <div class="col-md-8">
                        <h2>{{meal.name}}</h2>
                        <p>BY <b>{{meal.shop_name}}</b> store</p>
                        <p>NG₦{{meal.price}}</p>
                    </div>
                </router-link>
                <div class="dropdown col-md-1">
                    <div class="btn px-0" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        </svg>
                    </div>
                    <div class="dropdown-menu px-3" aria-labelledby="dropdownMenu2">
                        <li><a href="">Remove from bookmark</a></li>
                        <li><a href="">Share</a></li>
                        <li><router-link :to="{ path: '/shop/'}">
                                    View vendor profile
                            </router-link>
                        </li><br>
                        <li><a class="btn btn-outline-dark" id="close">Close</a></li>
                    </div>
                </div>
            </div><hr>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            meals: [
                {
                    name: 'Efo riro soup',
                    image: 'Flower',
                    shop_name: 'Amala Peckham',
                    price: '9,000'
                },
                {
                    name: 'Small chops',
                    image: 'Cup',
                    shop_name: 'Meals by Zeezee',
                    price: '500'
                },
                {
                    name: 'Ice glazed doughnut',
                    image: 'chair',
                    shop_name: 'Sugar Vendor',
                    price: '1,200'
                },
                {
                    name: 'Beans and plantain',
                    image: 'lamp',
                    shop_name: 'Oreoluwa foods',
                    price: '2,350'
                },
                {
                    name: 'Gizdodo',
                    image: 'card',
                    shop_name: 'Imade foods',
                    price: '3,000'
                },
            ],
            shops: [
                {
                    image: 'card',
                    shop_name: 'Imade foods'
                },
                {
                    image: 'lamp',
                    shop_name: 'Oreoluwa foods',
                },
                {
                    image: 'chair',
                    shop_name: 'Sugar Vendor',
                },
                {
                    image: 'Cup',
                    shop_name: 'Meals by Zeezee',
                },
                {
                    image: 'Flower',
                    shop_name: 'Amala Peckham',
                }

            ]
        }
    },
    methods:{
        scroll(n){
        document.getElementById('content').scrollLeft += n;
        },
    }
}
</script>

<style scoped>
    .block{
        max-width: 500px;
        margin: 0px 250px;
    }
    .user_image{
        width: 115px;
        height: 115px;
        border-radius: 4px;
    }
    .dropdown-menu{
        width: 210px;
    }
    .shop_image{
        width: 45px;
        height: 45px;
        border-radius: 4px;
    }
    .hr-scroll{
        display: flex;
        width: 500px;
        height: 100px;    
    }
    #content{
        overflow-y: hidden;
        overflow-x: scroll;
        width: 450px;
        display: flex;
    }
    .slide{
        background-color: transparent; 
        border: none;
    }
</style>