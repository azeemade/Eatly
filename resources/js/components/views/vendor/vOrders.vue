<template>
    <div>
        <div class="d-flex justify-content-around mb-5 border-top border-bottom py-3">
            <div>
                <router-link to="/undelivered-orders" class="tablinks">Undelivered Orders</router-link>
            </div>
            <div>
                <router-link to="/delivered-orders" class="tablinks">Delivered Orders</router-link>
            </div>
        </div>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<style>
    .router-link-exact-active.router-link-active.tablinks {
        border-bottom: 2px solid;
        padding-bottom: 1rem;
    }
</style>
<script>
export default {

    mounted(){
        let id = this.$store.state.id
        this.$store.dispatch('fetchUndelivered', id)
        this.$store.dispatch('fetchDelivered', id)
    }, 
}
</script>