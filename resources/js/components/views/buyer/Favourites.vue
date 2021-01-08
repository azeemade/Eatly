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
    .image-section{
        width: 100%;
        position: relative;
    }
    .image-overlay{
        position: absolute;
        width: 160px;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        opacity: 0;
        background-color: #000;
        transition: .3s ease;
    }
    .image-section:hover .image-overlay {
        opacity: 0.2;
    }

    .image-overlay-icon {
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
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