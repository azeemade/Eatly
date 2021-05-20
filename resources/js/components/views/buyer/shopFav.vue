<template>
    <div>
        <!--<div>
            filters
        </div>-->
        <div v-if="favShop.length > 0" class="row">
            <div class="mb-5 col-md-3 col-6 fav-shop-card" v-for="(shop, index) in favShop" :key="index">
                <div class="shop-image-section">
                    <div>
                        <img :src="'/images/'+ shop.shop_image + '.jpg'" alt="" width="115" height="115"  class="rounded-circle">
                    </div>
                    <div class="shop-image-overlay">
                        <button class="image-overlay-icon btn"  @click.prevent="removeShop(shop)">
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart-fill image-overlay-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="">
                    <router-link :to="{ path: '/shop/'+shop.shop_name}">
                        <p>{{shop.shop_name}}</p>
                    </router-link>
                </div>
            </div>
            <div class="alert alert-secondary text-center mb-0" role="alert" v-if="message != null">
                <p>{{message}}</p>
            </div>
        </div>
        <div v-else class="no-fav">
            <div>
                <svg width="7em" height="7em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
            </div>
            <div>                                   
                <p>Favourite shop is empty</p>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            message: null,
        }
    },
    methods:{
        removeShop(shop) {
           axios.delete(`http://127.0.0.1:8000/api/v1/favourite/delete/shop?user_id=${this.$store.state.id}&shop_id=${shop.id}`)
           .then(response =>  {
               this.message = response.data.message
               setTimeout(() => {
                    this.message = null;
                }, 3000);
                
               this.$store.commit('REMOVE_SHOP_FAVOURITE', {shop})
               })
        },
    },

    computed:{
        ...mapGetters([
            'favShop'
        ])
    },
}
</script>
<style>
    .fav-shop-card{
        justify-content: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .shop-image-section{
        width: 115px;
        height: 115px;
        position: relative;
    }
    .shop-image-overlay{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        opacity: 0;
        background-color: #000;
        transition: .3s ease;
        width: 115px;
        border-radius: 50%
    }
    .shop-image-section:hover .shop-image-overlay {
        opacity: 0.3;
    }
</style>