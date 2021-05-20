<template>
    <div class="">
        <div>
            <div class="d-flex justify-content-around mb-5 border-top border-bottom py-3">
                <div>
                    <router-link to="/favourites/meal" class="tablinks">
                        Favourite meal<span class="badge badge-secondary ml-2">{{$store.state.favMeal.length}}</span>
                    </router-link>
                </div>
                <div>
                    <router-link to="/favourites/shop" class="tablinks">
                        Favourite shop<span class="badge badge-secondary ml-2"> {{$store.state.favShop.length}}</span>
                    </router-link>
                </div>
            </div>
            <div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<style>
    .router-link-exact-active.router-link-active.tablinks {
        border-bottom: 2px solid;
        padding-bottom: 1rem;
    }

    .no-fav{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
<script>
export default {
    mounted(){
        this.$store.dispatch('fetchFavShop', this.$store.state.id)
        this.$store.dispatch('fetchFavMeal', this.$store.state.id)
    }, 
}
</script>