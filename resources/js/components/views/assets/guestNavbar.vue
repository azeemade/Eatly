<template>
    <div class="navbar justify-content-between d-flex">
        <router-link to="/" class="navbar-brand">
            <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="30" width="66">
        </router-link>
        <div class="hide">
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
                    <i class="bi bi-cart4"></i><span class="badge">{{ $store.state.cartCount }}</span>
                </button>
                <div class="cart-menu" id="cart-content">  
                    <cart :id="id"/>
                </div>
            </div>
            <div>
                <button class="btn cart-btn" type="button" @click="openMenu">
                    <i class="bi bi-justify-right"></i>
                </button>
                <div class="sidebar-menu" id="sidebar-content">  
                    <sidemenu />
                </div>
            </div>
        </div>
    </div>
</template>