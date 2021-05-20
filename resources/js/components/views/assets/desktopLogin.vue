<template>
    <div>
        <!--Logo -->
            <div class="container bg-white form-content">
                <h1>Sign in</h1>
                <div class="form-floating mb-3">
                    <input type="text" id="email" v-model="email" class="text-input form-control" placeholder="johndoe@example.com">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="password" v-model="password" class="text-input form-control" placeholder="password">
                    <label for="password">Password</label>
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
</template>
<script>
export default {
    name: 'desktopLogin',
    data(){
        return {
            email: '',
            password: '',
      }
    },

}
</script>
<style>
    .form-content{
        width: 450px;
    }
    .text-input{
        background: transparent;
        border: none;
        border-bottom: 1px solid #A9A7A7;
    }
    .auth-btn{
        background: #DDA30E;
        border-radius: 4px;
    }
    .signup-text{
        color: #FDC5