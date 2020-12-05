<template>
    <div class="nav-wrapper-container fixed-top">
        <div class="navbar justify-content-between d-flex">
            <div>
                <router-link to="/" class="navbar-brand">Eatly</router-link>
            </div>
            <div v-if="user_type == `consumer` || !isLoggedIn">
                <form action="" class="d-flex">
                    <input type="search" placeholder="Search" size="40" class="form-control">
                    <button type="submit" class="btn">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div>
                <div v-if="isLoggedIn">
                    <div class="d-flex">
                        <div class="mr-2">
                        <!--    <router-link to="" class="btn add-btn" title="Add recipe" v-if="user_type == `consumer`">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </router-link>-->
                            <router-link :to="{ path: '/vendor/add-meal/'}" class="btn add-btn" title="Add meal" v-if="user_type == `vendor`">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </router-link>
                        </div>
                        <div class="mr-2" v-if="user_type == `consumer`">
                            <button class="btn" id="dropdownMenux" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg><span class="badge">{{ $store.state.cartCount }}</span>
                            </button>
                            <div class="dropdown-menu droppy" aria-labelledby="dropdownMenux">
                                <cart :cart="cart" :id="id"/>
                            </div>
                        </div>
                        <div class="mr-2">
                            <button class="btn" type="button"  id="dropdownMenuy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuy">
                                <notification/>
                            </div>
                        </div>
                        <!--<div class="mr-2">
                            <button class="btn" type="button" aria-labelledby="dropdownMenuz" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuz">
                                <message />
                            </div>
                        </div>-->
                         <div class="">
                            <button class="btn" aria-labelledby="dropdownMenua" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenua">
                                <account />
                            </div>
                        </div>               
                    </div>
                    <!--<div class="dropdown" v-if="isLoggedIn">-->
                    <!--    <div class="btn dropdownBtn" type="button" @click="dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>
                    <div id="myDropdown" class="dropdown-content">   
                        <div class="btn dropdown-item">
                            <div class="dropdown-top">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                </svg>
                            </div>
                            <div class="dropdown-bottom">
                                <router-link to="/inbox">Message</router-link>
                            </div>
                        </div>
                        <div class="btn dropdown-item">
                            <div class="dropdown-top">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                            </div>
                            <div class="dropdown-bottom">
                                <router-link to="/cart">Cart ({{ $store.state.cartCount }})</router-link>
                            </div>
                        </div>         
                        <div class="btn dropdown-item">
                            <div class="dropdown-top">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                                </svg>
                            </div>
                            <div class="dropdown-bottom">
                                <router-link to="/notification">Notification</router-link>
                            </div>
                        </div>
                        <div class="btn dropdown-item">
                            <div class="dropdown-top">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-collection-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7z"/>
                                    <path fill-rule="evenodd" d="M2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                                </svg>
                            </div>
                            <div class="dropdown-bottom">
                                <router-link to="/subscriptions">Subscriptions</router-link>
                            </div>
                        </div>-->
                    <!--    <ul class="dropdown-menu px-3" aria-labelledby="dashboardMenu">
                            <li v-if="user_type == `consumer`"><router-link to="/login">User Profile</router-link></li>
                            <li v-if="user_type == `vendor`"><router-link to="/login">Vendor Profile</router-link></li>
                            <li><router-link to="/login">Setting</router-link></li><hr>
                            <li @click="logout" v-if="isLoggedIn">Logout</li>
                        </ul>
                    </div>-->
                    <!-- <div class="btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div style="padding-right: 7px;">
                            <img :src="require('../../../../../public/images/rocket.png')" alt="" width="30px" class="user_image">
                        </div>
                        <div>
                            <span v-if="user_type == `consumer`">{{ username}}</span>
                            <span v-if="user_type == `vendor`">{{ username}}</span>
                            <span v-if="user_type == `admin`">{{ username}}</span>
                        </div>      
                    </div>
                    <div>            
                        <ul class="dropdown-menu px-3" aria-labelledby="dashboardMenu">
                            <li v-if="user_type == `consumer`"><router-link to="/login">User Profile</router-link></li>
                            <li v-if="user_type == `vendor`"><router-link to="/login">Vendor Profile</router-link></li>
                            <li><router-link to="/login">Setting</router-link></li><hr>
                            <li @click="logout" v-if="isLoggedIn">Logout</li>
                        </ul>
                    </div>-->
                </div>
                <div v-else>
                    <div class="dropdown" >
                        <div class="btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div style="padding-right: 7px;">
                                <svg width="15px" height="15px" viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </div>
                            <div>
                                <svg width="15px" height="15px" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </div>      
                        </div>
                        <div>
                            <ul class="dropdown-menu px-3" aria-labelledby="dropdownMenu1">
                                <li><router-link to="/login">Login</router-link></li>
                                <li><router-link to="/login">Signup</router-link></li><hr>
                                <li><router-link to="/register/vendor" class="reg">Register as food vendor</router-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .nav-wrapper-container{
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        background-color: #f5f5f5;
    }
    .navbar{
        display: flex;
        justify-content: space-between;
        color: #D4CC00;
    }

    .dropdown .btn#dropdownMenu1{
        display: flex;        
        color: #212529;      
        border: 1px solid #707070;      
        border-radius: 0.25rem;
    }
    ul.dropdown-menu{
        min-width: 12rem;
    }

    .reg{
        background-color: #FFDB00;
        border-radius: 7px;
        font-size: 13px;
        border: 1px;
        padding: 8px;
        display: flex;
        justify-content: center;
    }
    .user_image{
        border-radius: 50%;
        padding: 3px;
        height: 30px;
    }
    .nav-dropdown{
        position: relative;
        display: inline-block;
    }
    .dropdown-content{
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 500px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    .dropdown-item{
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        font-size: 10px;
        text-align: center;
    }
    .show{display: grid;}
    .dropdownBtn{
        border: 1px solid #707070;
        border-radius: 0.25rem;
    }
    div button.btn{
        background-color: #00000052;
    }
    div .add-btn.btn{
        background-color: #00000052;
    }
    .dropdown-menu{
        right: 0;
        left:auto; 
    }
    .droppy{
        width: 350px;
        height: 500px;
        overflow: scroll;
    }
</style>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            user_type: "consumer",
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            username: null,
            id: null,
          //  cart: [],
        }
    },
    methods:{
        setDefaults(){
            if (this.isLoggedIn){
                let user = JSON.parse(localStorage.getItem('eatly.user'))
                this.username = user.username 
                this.user_type = user.role
                this.id = user.id
            }
        },

        change(){
            this.isLoggedIn = localStorage.getItem('eatly.jwt') != null
            this.setDefaults()
        },

        logout(){
            localStorage.removeItem('eatly.jwt')
            localStorage.removeItem('eatly.user')
            this.change()
            this.$router.push('/')
        },

        loadCart(){
            let user_id = this.id
            axios.get(`http://127.0.0.1:8000/api/cart?id=${user_id}`)
            .then(response => this.cart = response.data.data.cart.meals)
            .catch(console.error)
        }
    },

    beforeMount(){
        this.setDefaults();
    },

    mounted(){
        this.$store.commit('SET_ID', this.id);
        this.$store.dispatch('fetchCart', this.id)
    },
    computed: {
        ...mapGetters([
            'cart'
        ])
    }
}
</script>