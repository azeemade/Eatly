<template>
   <div class="container block">
        <div>
            <image-upload :image="'/images/'+ user.user_image" class="d-flex justify-content-center" :editingMode="true"/>
        </div>
        <div class="row my-3">
            <div class="col-md-6 col-6">
                <p>FIRSTNAME:</p>
                <input type="text" class="form-control border-bottom-input mr-2" v-model="user.firstname">
            </div>
            <div class="col-md-6 col-6">
                <p>LASTNAME:</p>
                <input type="text" class="form-control border-bottom-input mr-2" v-model="user.lastname">
            </div>
        </div> 
        <div class="row my-3">
            <div class="col-md-6 col-6">
                <p>DISPLAYNAME:</p>
                <input type="text" class="form-control border-bottom-input mr-2" v-model="user.displayName">
            </div>
            <div class="col-md-6 col-6">
                <p>USERNAME:</p>
                <input type="text" class="form-control border-bottom-input mr-2" v-model="user.username">
            </div>
        </div>
        <div class="mt-3">
            <p>EMAIL:</p>
            <input type="text" class="form-control border-bottom-input mr-2" v-model="user.email" disabled>
        </div>
        <div class="mt-3">
            <p>PHONENUMBER:</p>
            <input type="text" class="form-control border-bottom-input mr-2" v-model="user.phoneNumber">
        </div>
        <div v-if="message != null">
            <div class="alert alert-danger text-center" role="alert">
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
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            user: {},
            hasError: true,
            message: null
        }
    },
    methods:{
        update(){
            var user = this.user;
            if (user['firstname'] == "" || user['lastname'] == "" || user['displayName'] == "" || 
                user['username'] == "" || user['phoneNumber'] == "" || this.master_image == null){
                this.hasError = false;
            }
            else {
                this.hasError = true;

                let formData = new FormData();
                formData.append("_method", "PUT")
                formData.append("firstname", this.user.firstname);
                formData.append("lastname", this.user.lastname);
                formData.append("masterImage", this.master_image);
                formData.append("email", this.user.email);
                formData.append("displayName", this.user.displayName);
                formData.append("username", this.user.username);
                formData.append("phoneNumber", this.user.phoneNumber);

                console.log(this.master_image);

                axios.post(`/api/v1/user/update?id=${this.$store.state.id}`, formData, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response => {
                        if(response.data.message === 'Profile updated successfully'){
                            this.$router.push('/home')
                            this.$store.commit('SET_MESSAGE', response.data.message)
                            setTimeout(() => {
                                this.$store.state.message = null;
                            }, 3000);
                        }
                        else{
                            this.message = response.data.message 
                        }                              
                    })
            }
        }
    },

    beforeMount(){
        axios.get(`/api/v1/user/show?user_id=8`)
        .then(response => this.user = response.data.data)
    },

    computed:{
        ...mapGetters(
            ['master_image']
        )
    },
}
</script>
<style scoped>
    .yellow-btn{
        background: #A98402;
    }
</style>