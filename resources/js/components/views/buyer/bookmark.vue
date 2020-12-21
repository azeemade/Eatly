<template>
    <div class="">
        <div>
            <div class="d-flex justify-content-around mb-5 border-top border-bottom py-3">
                <div>
                    <router-link to="/bookmark/meal" class="tablinks">
                        Bookmarked meal<span class="badge badge-secondary ml-2">{{$store.state.bookmarkMeal.length}}</span>
                    </router-link>
                </div>
                <div>
                    <router-link to="/bookmark/shop" class="tablinks">
                        Bookmarked shop<span class="badge badge-secondary ml-2"> {{$store.state.bookmarkShop.length}}</span>
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
</style>
<script>
export default {
    mounted(){
        this.$store.dispatch('fetchBookmarkShop', this.$store.state.id)
        this.$store.dispatch('fetchBookmarkMeal', this.$store.state.id)
    }, 
}
</script>