<template>
    <div class="nav-wrapper-container fixed-top">
        <div class="">
            <div v-if="$route.meta.name === 'uDashboard'">
                <userNavbar />
            </div>

            <div v-else-if="$route.meta.name === 'vDashboard'">
                <vendorNavbar />
            </div>
            <div v-else-if="$route.meta.name === 'auth'">
                <div></div>
            </div>
            <div v-else>
                <guestNavbar />
            </div>
        </div>
    </div>
</template>
<style>
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
    .desktop{
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
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
    }

    #search-content-md{
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
    @media only screen and (min-width: 768px) {
        .desktop{
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
import {mapGetters} from 'vuex';
import vendorNavbar from '../assets/vendorNavbar.vue';
import userNavbar from '../assets/userNavbar.vue';
import guestNavbar from '../assets/guestNavbar.vue';
export default {
    components: { vendorNavbar, userNavbar, guestNavbar},
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
        openMenu(){
            document.getElementById("sidebar-content").style.display = "block";
        }

    },

    beforeMount(){     
        this.$store.commit('SET_ID');

        var id = this.$store.state.id
        //this.$store.dispatch('setShopName',id)
        this.$store.dispatch('setShop',id)
        

        this.setDefaults();
       // axios.get(`http://127.0.0.1:8000/api/v1/shop/shop-name?user_id=${this.id}`)
       // .then(response => this.shop_name = response.data.data.shop_name)

    },

    mounted(){
     //   this.$store.commit('SET_ID');
      //  this.$store.dispatch('setShopName', this.$store.state.id)
       // this.$store.commit('SET_ID', this.id);
       // this.$store.dispatch('fetchCart', this.id)
        this.$store.dispatch('fetchUser', this.id)
        
    },
    computed: {
        ...mapGetters([
            'cart'
        ])
    }
}
</script>