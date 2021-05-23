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
import {mapGetters} from 'vuex';
export default {
    name: 'userNavbar',
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
            this.$store.dispatch('storeSearch', {id, search})
            this.$store.commit('NEW_SEARCH', search)
        },

        openCart(){
            document.getElementById("cart-content").style.display = "block";
        },

    },

    beforeMount(){     
        this.$store.commit('SET_ID');

        var id = this.$store.state.id
        this.$store.dispatch('setShop',id)
        

        this.setDefaults();

    },

    mounted(){
        this.$store.dispatch('fetchUser', this.id)
        
    },
    computed: {
        ...mapGetters([
            'cart'
        ])
    }
}
</script>