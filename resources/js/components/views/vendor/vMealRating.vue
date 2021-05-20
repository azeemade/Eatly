<template>
    <div>
        <star-rating  class="justify-content-center"
        v-model="rating" :read-only="true" 
        :increment="0.5" :star-size="20">
        </star-rating>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
import StarRating from 'vue-star-rating'
export default {  
    props: ['rating'],

    components: {
        StarRating
    },
}
</script>
