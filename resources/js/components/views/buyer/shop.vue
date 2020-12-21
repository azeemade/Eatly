<template>
    <div>
        <div class="row my-3">
            <div class="col-md-3">
                <img :src="'/images/'+ shop.image + '.jpg'" alt="" width="200" height="200"  class="rounded border">
            </div>
            <div class="col-md-5">
                <h4 style="font-weight: 100">{{shop.ShopName}}</h4>
                <p>{{shop.description}}</p>
                <div>
                    <p>{{sells}} Sales | Joined since {{shop.created_at}}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="mr-3">{{meals.length}} active meals</p>
                    <button class="btn-outline-secondary btn-lg btn" @click.prevent="bookmarkShop(shop)">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmarks mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                            <path fill-rule="evenodd" d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                        </svg>
                        Bookmark shop
                    </button>
                </div>
            </div>
            <div class="col-md-4 justify-content-center" style="display:grid;">
                <h5 style="font-weight:100;">Shop owner</h5>
                <!--<img :src="'/images/'+ shopOwner.user.UserImage + '.jpg'" alt="" width="115" height="115"  class="rounded-circle">-->
                <p class="text-center"><b>{{shopOwner.user.username}}</b></p>
            </div>
        </div>
        <div class="alert alert-warning alert-dismissible text-center " role="alert" v-bind:class="{hidden: hasShop}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Shop already in bookmark
        </div>
        <div v-if="errored">
            <p>This info isnt available rn</p>
        </div>
        <div v-else>
            <div v-if="loading">Loading...</div>
            <div>
                <h6 style="font-weight: 100;">Top meals</h6>
                <div class="row mt-3">
                    <div class="col-md-3 mb-5" v-for="(meal, index) in meals" :key="index">
                        <div class="border-0 p-3">                      
                            <div class="card-body p-0">
                                <router-link :to="{ path: '/meal/'+meal.id}">
                                    <div class="card-img-top">
                                        <img :src="'/images/'+ meal.image" alt="" width="115" height="115" class="rounded">
                                    </div>
                                </router-link>
                                <div class="card-title mb-0">
                                    <p>{{meal.name}}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="card-text">
                                        <p>NG₦{{meal.price}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h6 style="font-weight: 100;">All meals</h6>
                <div class="row mt-3">
                    <div class="col-md-3 mb-5" v-for="(meal, index) in meals" :key="index">
                        <div class="border-0 p-3">                      
                            <div class="card-body p-0">
                                <router-link :to="{ path: '/meal/'+meal.id}">
                                    <div class="card-img-top">
                                        <img :src="'/images/'+ meal.image" alt="" width="115" height="115" class="rounded">
                                    </div>
                                </router-link>
                                <div class="card-title mb-0">
                                    <p>{{meal.name}}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="card-text">
                                        <p>NG₦{{meal.price}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            meals: [],
            loading: true,
            errored: false,
            shop: [],
            shopOwner: [],
            sells: '',
            hasShop: true
        }
    },

    beforeMount(){
        let url =  `/api/shops/${this.$route.params.id}`
        axios.get(url).then(response => this.shop = response.data.data)
    },

    mounted(){
        let url_ =  `http://127.0.0.1:8000/api/mealDetails/${this.$route.params.id}`
        axios.get(url_).then(response => this.meals = response.data)
        .catch(error => {console.log(error)
        this.errored = true})
        .finally(() => this.loading = false)    
        
        let url__ =  `/api/shop/user/${this.$route.params.id}`
        axios.get(url__).then(response => this.shopOwner = response.data.data.shop)

        let url_2 =  `/api/shop/${this.$route.params.id}/sells`
        axios.get(url_2).then(response => this.sells = response.data)

        this.$store.dispatch('fetchBookmarkShop', this.$store.state.id)
    },

    methods:{
        bookmarkShop(shop){
            let shop_id = this.shop.id
            let id = this.$store.state.id
            let found = this.$store.state.bookmarkShop.find(item => item.id == shop_id);

            if (found) {
                this.hasShop = false;
            } else {
                this.hasShop = true;
            axios.post('http://127.0.0.1:8000/api/bookmark/shop/'+shop_id, {shop_id, id})
            .then(response => this.$store.commit('ADD_TO_BOOKMARK_SHOP', {shop}))
            alert('Shop added to bookmark')
            }
        }, 
    }
}
</script>

<style scoped>
    .border-0{
        width: 147px;
        height: 220px;
        border-radius: 8px;
        background-color: #80808033;
    }
</style>