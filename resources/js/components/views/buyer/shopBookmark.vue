<template>
    <div>
        <!--<div>
            filters
        </div>-->
        <div v-if="$store.state.bookmarkShop.length > 0" class="row">
            <div class="mb-5 px-5" v-for="(shop, index) in $store.state.bookmarkShop" :key="index">
                <div class="card-body p-0">
                    <router-link :to="{ path: '/shop/'+shop.id}">
                        <div>
                            <img :src="'/images/'+ shop.image + '.jpg'" alt="" width="115" height="115"  class="rounded-circle border">
                        </div>
                    </router-link>
                        <div class="mb-0 mt-1 d-flex align-items-baseline justify-content-around border shop-name">
                            <p class="text-center">{{shop.ShopName}}</p>

                            <a href class="btn p-0" @click.prevent="removeShop(shop)">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5V2z"/>
                                </svg>
                            </a>
                        </div>
                    
                </div>
            </div>
        </div>
        <div v-else class="navbar-dropdown">
            <a class="navbar-item">
                Bookmarked shop is empty
            </a>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        removeShop(shop) {
           axios.delete(`http://127.0.0.1:8000/api/bookmark/shop/${shop.id}?id=${this.$store.state.id}&shop_id=${shop.id}`)
           .then(response =>  this.$store.commit('REMOVE_SHOP_BOOKMARK', {shop}))
           alert('Shop removed')
        },
    },
}
</script>
<style scoped>
    .shop-name{
        border-radius: 4px;
        height: 30px;
    }
    .load {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }
    /* Standard syntax */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>