<template>
    <div class="bg-secondary">
        <!--Logo -->
        <div class="container">
            <div class="container bg-white">
                <h1>Sign in</h1>
                <div class="mb-3">
                    <input type="text" placeholder="Email" v-model="email" class="text-input form-control">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Password" v-model="password" class="text-input form-control">
                </div>
                <button class="text-white btn auth-btn" @click="handleSubmit">Login</button>
                <div class="mt-3">
                    <router-link to="" class="mb-2">Forgotten password?</router-link>
                    <div class="mb-2">
                        <p>Not yet registered? 
                            <router-link to="#" class="signup-text">Sign up</router-link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'mobileLogin',
    data(){
        return {
            email: '',
            password: '',
      }
    },
}
</script>
<style scoped>
    .text-input{
        background: rgba(229, 229, 229, 0.5);
        border-radius: 4px;
    }
    .text-input::placeholder{
        color: #A9A7A7;
    }
    .auth-btn{
        background: #DDA30E;
        border-radius: 4px;
    }
    .signup-text{
        color: #FDC500;
        text-decoration: underline;
    }
</style>