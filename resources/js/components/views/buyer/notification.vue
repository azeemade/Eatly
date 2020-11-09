<template>
    <div class="">
        <div class="mb-3" v-for="(shop, index) in shops" :key="index">
            <div class="d-flex">
                <div class="mr-3">
                <!--    <img :src="require('../../../../../public/images/' +shop.image+ '.png')" alt="" width="45px" class="user_image">-->
                </div>
                <div>
                    <p><b>{{shop.name}}</b> added a new meal</p>   
                    <p>{{shop.date}}</p>
                </div>
            </div><hr>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            shops: [
                {
                    name: 'Ibadan Queen',
                    image: 'Flower',
                    date: 'Oct 4'
                },
                {
                    name: 'Amala Peckham',
                    image: 'Cup',
                    date: 'Oct 1'
                },
                {
                    name: 'Meals by Zeezee',
                    image: 'chair',
                    date: 'Sept 30'
                },
                {
                    name: 'Sugar Vendor',
                    image: 'lamp',
                    date: 'Sept 30'
                },
                {
                    name: 'Oreoluwa foods',
                    image: 'card',
                    date: 'Sept 19'
                },
            ]
        }
    }
}
</script>

<style scoped>
    .user_image{
        border-radius: 50%;
        padding: 3px;
        height: 45px;
    }
</style>