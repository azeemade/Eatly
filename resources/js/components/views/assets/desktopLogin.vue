<template>
    <div class="container form-wrapper p-3">
            <div class="my-3">
                <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="40" width="66">
            </div>
            <div class="container bg-white rounded-3 py-3 px-4">
                <div class="d-flex align-items-center">
                    <a class="btn">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <a class="fs-5 text-decoration-none">Sign in</a>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="email" v-model="email" class="text-input form-control" placeholder="johndoe@example.com">
                    <label for="email" class="small">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" id="password" v-model="password" class="text-input form-control" placeholder="password">
                    <label for="password" class="small">Password</label>
                    <router-link to="">
                        <i class="small fst-normal text-decoration-none">Forgotten password?</i>
                    </router-link>
                </div>
                <span class="small text-danger m-1">{{error}}</span>
                <div class="d-flex justify-content-center">
                    <button class="text-white btn auth-btn" @click="handleSubmit">{{signin}}</button>
                </div>
                <div class="my-3">
                        <router-link to="/register" class="signup-text">Create account</router-link>
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
            signin: 'Sign in',
            error: '',
      }
    },

    methods:{
        handleSubmit(e) {
            e.preventDefault()
            document.getElementById("loginBtn").disabled = true;
            this.signin = 'Signing in...'

            if (this.password.length > 0) {
                this.loading = true;
                axios.post('api/v1/auth/login', {
                    email: this.email, 
                    password: this.password
                    })
                .then(response => {
                    let role = response.data.user.role

                    localStorage.setItem('eatly.user', JSON.stringify(response.data.user))
                    localStorage.setItem('eatly.jwt', response.data.token)

                    if (localStorage.getItem('eatly.jwt') != null) {
                        this.$emit('loggedIn')
                        if (this.$route.params.nextUrl != null) {
                            this.$router.push(this.$route.params.nextUrl)
                        } else {
                            if (role == "user"){
                                this.$router.push('/home')
                            }else{
                                if (role == "admin"){
                                    this.$router.push('/admin')
                                }
                            }
                        }
                    }
                })
                .catch(err => {
                    this.error = err.response.data.error
                    this.signin = 'Sign in'
                })
            }
            else{
                this.error.error = 'email or password cannot be null'
            }
        }
    },
}
</script>
<style>
    .form-wrapper{
        width: 450px;
        box-shadow: 0px 2px 6px rgb(0 0 0 / 20%);
        background: #F5F5F5;
    }
    .text-input{
        background: transparent;
        border: none;
        border-bottom: 1px solid #A9A7A7;
    }
    .auth-btn{
        background: #DDA30E;
        border-radius: 4px;
        width: 50%;
    }
    .signup-text{
        color: #dda30e;
        text-decoration: underline;
    }
</style>