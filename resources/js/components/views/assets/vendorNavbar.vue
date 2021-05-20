<template>
    <div class="navbar justify-content-between d-flex">
        <router-link to="/vendor/home" class="navbar-brand">
            <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
        </router-link>
        <div class="d-flex">
            <div class="mr-2">
                <button class="btn cart-btn" type="button" @click="openCart">
                    <i class="bi bi-bell"></i>
                    <!--<span class="badge">{{ $store.state.cartCount }}</span>-->
                </button>
                <div class="cart-menu" id="cart-content">  
                    <cart/>
                </div>
            </div>
            <button class="btn"  data-toggle="modal" data-target="#vAccountModal">
                <i class="bi bi-justify-right"></i>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'vendorNavbar'
}
</script>