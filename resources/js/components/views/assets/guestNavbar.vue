<template>
    <div class="navbar justify-content-between d-flex">
        <router-link to="/" class="navbar-brand">
            <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
        </router-link>
        <div class="desktop">
            <div class="d-flex align-items-baseline">
                <input type="search" placeholder="Search" size="40" class="form-control mr-2"  v-model="search">
                <router-link :to="{ path: '/search/meal/?q='+search}" @click="openSearch">
                    <i class="bi bi-search"></i>
                </router-link>
            </div>
            <!--<div id="search-content-md">
                <search-result />
            </div>-->
        </div>
        <div class="d-flex">
            <div>
                <button class="btn cart-btn" type="button" @click="openCart">
                    <i class="bi bi-cart4"></i><span class="badge text-warning">{{ $store.state.cartCount }}</span>
                </button>
                <div class="cart-menu" id="cart-content">  
                    <cart />
                </div>
            </div>
            <div class="dropdown">
                <button class="btn cart-btn dropdown-toggle" type="button" id="accountBtn" 
                data-bs-toggle="dropdown" aria-expanded="flase">
                    <i class="bi bi-person"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountBtn">
                    <li>
                        <a class="dropdown-item">
                            <router-link to="/login" class="btn">Login</router-link>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item">
                            <router-link to="/register" class="btn">Register</router-link>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-menu" id="sidebar-content">  
                    <sidemenu />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            search: '',
        }
    },
    methods:{

        openSearch(){
            let id = this.$store.state.id;
            let search = this.search;
            this.$store.dispatch('storeSearch', {id, search})
            this.$store.commit('NEW_SEARCH', search)
        },

        openCart(){
            document.getElementById("cart-content").style.display = "block";
        },

    }
}
</script>