<template>
    <div class="navbar justify-content-between d-flex">
        <router-link to="/home" class="navbar-brand">
            <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
        </router-link>
        <div class="d-flex align-items-baseline">
            <input type="search" placeholder="Search" size="40" class="form-control mr-2"  v-model="search">
            <router-link :to="{ path: '/search/meal/?q='+search}" @click="openSearch">
                <i class="bi bi-search"></i>
            </router-link>
        </div>
        <div class="d-flex">
            <div class="mr-2">
                <button class="btn cart-btn" type="button" @click="openCart">
                    <i class="bi bi-bell"></i><!--<span class="badge">{{ $store.state.cartCount }}</span>-->
                </button>
                <div class="cart-menu" id="cart-content">  
                    <cart/>
                </div>
            </div>
            <div class="mr-2">
                <button class="btn cart-btn" type="button" @click="openCart">
                    <i class="bi bi-cart4"></i><span class="badge">{{ $store.state.cartCount }}</span>
                </button>
                <div class="cart-menu" id="cart-content">  
                    <cart/>
                </div>
            </div> 
            <div>
                <button class="btn"  data-toggle="modal" data-target="#accountModal">
                    <img :src="'/images/'+ image + '.png'" alt="" width="20.8px" height="20.8px" class="rounded-circle">
                </button>
            </div> 
        </div>
    </div>
</template>
<script>
export default {
    name: 'userNavbar'
}
</script>