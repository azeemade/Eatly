<template>
    <div class="nav-wrapper-container fixed-top">
        <div class="navbar justify-content-between d-flex">
            <div>
                <router-link v-if="$route.meta.name === 'uDashboard'" to="/home" class="navbar-brand">
                    <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
                </router-link>
                <router-link v-else-if="$route.meta.name === 'vDashboard'" :to="{ path: '/vendor/'+shop_name}" class="navbar-brand">
                    <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
                </router-link>
                <router-link v-else to="/" class="navbar-brand">
                    <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
                </router-link>
            </div>
            <!--<div v-if="user_type == `user` && hasShop == `No` || !isLoggedIn" class="hide">-->
            <div v-if="!isLoggedIn || $route.meta.name === 'uDashboard'" class="hide">
                <div class="d-flex">
                    <input type="search" placeholder="Search" size="40" class="form-control"  v-model="search">
                    <button type="submit" class="btn" @click="openSearch">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </div>
                <div id="search-content-md">
                    <search-result />
                </div>
            </div>
            <div>
                <div v-if="isLoggedIn">
                    <div class="d-flex">                       
                        <div class="mr-2">
                            <!--<router-link :to="{ path: '/vendor/add-meal/'}" class="btn add-btn" title="Add meal" v-if="user_type == `user` && hasShop == `Yes`">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </router-link>-->
                            <button class="btn cart-btn" type="button" @click="openCart">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
                                    <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                </svg><!--<span class="badge">{{ $store.state.cartCount }}</span>-->
                            </button>
                            <div class="cart-menu" id="cart-content">  
                                <cart :id="id"/>
                            </div>
                        </div>
                        <div v-if="$route.meta.name === 'uDashboard'" class="d-flex">
                            <div class="mr-2">
                                <button class="btn cart-btn" type="button" @click="openCart">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-cart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg><span class="badge">{{ $store.state.cartCount }}</span>
                                </button>
                                <div class="cart-menu" id="cart-content">  
                                    <cart :id="id"/>
                                </div>
                            </div> 
                            <div>
                                <button class="btn"  data-toggle="modal" data-target="#accountModal">
                                    <img :src="'/images/'+ image + '.png'" alt="" width="20.8px" height="20.8px" class="rounded-circle">
                                </button>
                            </div>                       
                        </div>
                        <div v-if="$route.meta.name === 'vDashboard'">
                            <button class="btn"  data-toggle="modal" data-target="#vAccountModal">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-justify-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </div>             
                    </div>
                </div>
                <div v-else class="d-flex">
                    <div>
                        <button class="btn cart-btn" type="button" @click="openCart">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-cart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg><span class="badge">{{ $store.state.cartCount }}</span>
                        </button>
                        <div class="cart-menu" id="cart-content">  
                            <cart :id="id"/>
                        </div>
                    </div>
                    <div>
                        <button class="btn cart-btn" type="button" @click="openMenu">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </button>
                        <div class="sidebar-menu" id="sidebar-content">  
                            <sidemenu />
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
        background-color: white;
    }
    .navbar{
        display: flex;
        justify-content: space-between;
    }
    div .add-btn.btn{
        background-color: #00000052;
    }
    .dropdown-menu{
        right: 0;
        left:auto; 
    }
    .hide{
        display: none;
        }
    #cart-content, #sidebar-content{
        display: none;
        width: 100%;
        overflow-y: auto;
        position: fixed;
        z-index: 1;
        right: 0;
        background-color: white;
        transition: 0.5s;
        border-radius: 20px 0px 20px 0px;
        height: 100%;
    }

    #search-content-md{
        display: none;
        width: 100%;
        overflow-y: scroll;
        position: fixed;
        z-index: 1;
        right: 0;
        background-color: white;
        transition: 0.5s;
        border-radius: 20px 0px 20px 0px;
        height: 100%;
    }
    @media only screen and (min-width: 768px) {
        .hide{
            display: block;
        }
        .logo{
            height: 45px;
            width: 105px;
        }
        #cart-content{
            width: 350px;
            transition: 1s;
            right: 0;
        }

    }
</style>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            user_type: null,
            isLoggedIn: localStorage.getItem('eatly.jwt') != null,
            username: null,
            id: null,
            hasShop: null,
            shop_name: null,
            image: null,
            search: '',
        }
    },
    methods:{
        setDefaults(){
            if (this.isLoggedIn){
                let user = JSON.parse(localStorage.getItem('eatly.user'))
                this.username = user.username 
                this.user_type = user.role
                this.id = user.id
                this.hasShop = user.hasShop
                this.image = user.user_image
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
        },

        openSearch(){
            let id = this.$store.state.id;
            let search = this.search;

            document.getElementById("search-content-md").style.display = "block";
            this.$store.dispatch('storeSearch', {id, search})
            this.$store.commit('NEW_SEARCH', search)
        },

        openCart(){
            document.getElementById("cart-content").style.display = "block";
        },
        openMenu(){
            document.getElementById("sidebar-content").style.display = "block";
        }

    },

    beforeMount(){
        this.setDefaults();
        axios.get(`http://127.0.0.1:8000/api/v1/shop/shop-name?user_id=${this.id}`)
        .then(response => this.shop_name = response.data.data.shop_name)
    },

    mounted(){
        this.$store.commit('SET_ID', this.id);
        this.$store.dispatch('fetchCart', this.id)
        this.$store.dispatch('fetchUser', this.id)
        
    },
    computed: {
        ...mapGetters([
            'cart'
        ])
    }
}
</script>