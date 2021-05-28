<template>
    <div class="container form-wrapper p-3">
        <div class="my-3">
            <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="40" width="66">
        </div>
        <div class="container bg-white rounded-3 py-3 px-4">
            <div class="d-flex align-items-center mb-4">
                <a class="btn ps-0" @click="goBack">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a class="fs-5 text-decoration-none">Create Account</a>
            </div>
            <div v-show="message" class="mb-2">
                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                    <p>{{message}}</p>
                </div>               
            </div>
            <div class="form-floating mb-3">
                <input type="text" id="rEmail" v-model="email" class="text-input form-control" placeholder="johndoe@example.com" required>
                <label for="rEmail" class="small">Email</label>
                <ul>
                    <li class="small text-danger" v-for="(eEmail, index) in errors.email" :key="index">{{eEmail}}</li>
                </ul>
            </div>
            <div class="form-floating mb-3">
                <input type="text" id="rUsername" v-model="username" class="text-input form-control" placeholder="cactusflower1920" required>
                <label for="rUsername" class="small">Username</label>
                <ul>
                    <li class="small text-danger" v-for="(eUsername, index) in errors.username" :key="index">{{eUsername}}</li>
                </ul>
            </div>
            <div class="form-floating mb-3">
                <input type="password" id="rPassword" v-model="password" class="text-input form-control  mb-3" placeholder="password" required>
                <label for="rPassword" class="small">Password</label>
                <ul>
                    <li class="small text-danger" v-for="(ePassword, index) in errors.password" :key="index">{{ePassword}}</li>
                </ul>
            </div>
            <div class="form-floating mb-4">
                <input type="password" id="rCPassword" v-model="confirmPassword" class="text-input form-control" placeholder="confirm password" required>
                <label for="rCPassword" class="small">Confrim Password</label>
                <ul>
                    <li class="small text-danger" v-for="(eCPassword, index) in errors.confirmPassword" :key="index">{{eCPassword}}</li>
                </ul>
            </div>
            <div class="d-flex justify-content-center">
                <button class="text-white btn auth-btn" @click="handleSubmit">{{ signup }}</button>
            </div>
            <div class="my-3">
                Already registered ?
                    <router-link to="/login" class="signup-text">Sign in</router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'desktopRegister',
    props: ['nextUrl'],
    data(){
        return {
            email: null,
            username: null,
            password: null,
            confirmPassword: null,
            signup: 'Create account',
            errors: [],
            isSubmitting: false,
            hasErrors: false,
            message: null,
        }
    },

    methods:{
        goBack(){
            this.$router.go(-1);
        },

        handleSubmit(e) {
            e.preventDefault();
            this.signup = 'Creating account...';
            this.errors = [];

            let username = this.username
            let email = this.email
            let password = this.password
            let confirmPassword = this.confirmPassword

            axios.post('api/v1/auth/register', {username, email, password, confirmPassword})
            .then((response) => {
                localStorage.setItem('eatly.user', JSON.stringify(response.data.status.user))
                localStorage.setItem('eatly.jwt', response.data.status.token)

                if (localStorage.getItem('eatly.jwt') != null) {
                    this.$emit('Account created!')
                    let nextUrl = this.$route.params.nextUrl
                    this.$router.push((nextUrl != null ? nextUrl: "/home"))

                    this.$store.commit('SET_MESSAGE', response.data.message)
                    setTimeout(() => {
                        this.$store.state.message = null;
                    }, 50000);
                }   
            })
            .catch(err => {
                this.errors = err.response.data.errors
                this.signup = 'Create account'
            })
        }
    }
}
</script>
<style>
    .form-wrapper{
        width: 450px;
        box-shadow: 0px 2px 6px rgb(0 0 0 / 20%);
        background: #F5F5F5;
    }
    .text-input{
        background: #F5F5F5;
        border: none;
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