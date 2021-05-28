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
//import {mapGetters} from 'vuex';
import vendorNavbar from '../assets/vendorNavbar.vue';
import userNavbar from '../assets/userNavbar.vue';
import guestNavbar from '../assets/guestNavbar.vue';
export default {
    components: { vendorNavbar, userNavbar, guestNavbar},
}
</script>