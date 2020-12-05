<template>
    <div>
        <div class="mt-3 row">
            <div class="mb-5 px-5" v-for="(shop, index) in shops" :key="index">
                <div class="card-body p-0">
                    <router-link :to="{ path: '/shop/'+shop.id}">
                        <div>
                            <img :src="require(`../../../../../public/images/${shop.image}.jpg`)" alt="meal image"  class="rounded-circle" width="115" height="115">
                        </div>
                    
                        <div class="card-title mb-0">
                            <p class="text-center">{{shop.name}}</p>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            shops: [],
            loading: true,
            errored: false,
        }
    },

    mounted(){
        axios.get("api/shops").then(response => this.shops = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)
    },
}
</script>
<style scoped>
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