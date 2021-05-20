<template>
    <div>
        <div class="d-flex justify-content-around mb-5 border-top border-bottom py-3">
            <div>
                <router-link to="/orders/open" class="tablinks">Open Orders</router-link>
            </div>
            <div>
                <router-link to="/orders/closed" class="tablinks">Closed Orders</router-link>
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
        this.$store.dispatch('fetchOpenOrders', this.$store.state.id)
        this.$store.dispatch('fetchClosedOrders', this.$store.state.id)
    }, 
}
</script>