<template>
    <div class="container block">
        <div>
            <image-upload :image="'/images/'+ shop.image+ '.jpg'" class="d-flex justify-content-center"/>
        </div>
        <div class="my-3">
            <p>SHOP NAME:</p>
            <input type="text" class="form-control border-bottom-input mr-2" v-model="shop.shop_name">
        </div> 
        <div>
            <p>SHOP ADDRESS:</p>
            <input type="text" class="form-control border-bottom-input mr-2" v-model="shop.address">
        </div>
        <div class="mt-3">
            <p>SHOP BIO:</p>
            <textarea rows="3" v-model="shop.bio" class="form-control"></textarea>
        </div>
        <div class="mt-3">
            <p>OPENING HOURS:</p>
            <div class="d-flex">
                <input type="time" class="form-control border-bottom-input w-50" v-model="shop.opening_time"> 
                to
                <input type="time" class="form-control border-bottom-input w-50" v-model="shop.close_time">
            </div>
        </div>
        <div v-if="message != null">
            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                <p>{{message}}</p>
            </div>               
        </div>
        <div class="alert alert-danger text-center" role="alert" v-bind:class="{hidden: hasError}">
            Please fill all the fields.
        </div>
        <button class="my-3 btn yellow-btn text-white" @click="update">
            Update profile
        </button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            shop: {},
            hasError: true,
            message: null
        }
    },
    methods:{
        update(){
            var shop = this.shop;
            if (shop['shop_name'] == "" || shop['address'] == "" || this.image == '' ||
                shop['bio'] == "" || shop['opening_time'] == "" || shop['close_time'] == "" ){
                this.hasError = false;
            }
            else {
                this.hasError = true;

                let formData = new FormData();
                formData.append("shop_name", this.shop.shop_name);
                formData.append("shop_address", this.shop.address);
                formData.append("shop_image", 'file');
                formData.append("shop_bio", this.shop.bio);
                formData.append("user_id", this.$store.state.id);
                formData.append("open_time", this.shop.opening_time);
                formData.append("close_time", this.shop.close_time);

                axios.post(`/api/v1/shop/store/`, formData, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response => {
                        if(response.data.message === 'Meal saved successfully'){
                            this.$router.push('/vendor/meals')
                            this.$store.commit('SET_MESSAGE', response.data.message)
                        }
                        else{
                            this.message = response.data.message 
                        }                              
                    })
            }
        }
    },

    beforeMount(){
        axios.get(`/api/v1/shop/vendor?user_id=8`)
        .then(response => this.shop = response.data.data)
    }
}
</script>
<style scoped>
    .yellow-btn{
        background: #A98402;
    }
</style>