<template>
    <div class="container">
        <div class="my-3">
            <img :src="'/images/eatly_new.svg'" alt="" class="rounded logo" height="40" width="66">
        </div>
        <div class="d-flex align-items-center mb-4">
            <a class="btn ps-0">
                <i class="bi bi-chevron-left"></i>
            </a>
            <a class="fs-5 text-decoration-none">Create Account</a>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="mrEmail" v-model="email" class="text-input form-control" placeholder="johndoe@example.com" required>
            <label for="mrEmail" class="small">Email</label>
            <ul>
                <li class="small text-danger" v-for="(eEmail, index) in errors.email" :key="index">{{eEmail}}</li>
            </ul>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="mrUsername" v-model="username" class="text-input form-control" placeholder="cactusflower1920" required>
            <label for="mrUsername" class="small">Username</label>
            <ul>
                <li class="small text-danger" v-for="(eUsername, index) in errors.username" :key="index">{{eUsername}}</li>
            </ul>
        </div>
        <div class="form-floating mb-3">
            <input type="password" id="mrPassword" v-model="password" class="text-input form-control  mb-3" placeholder="password" required>
            <label for="mrPassword" class="small">Password</label>
            <ul>
                <li class="small text-danger" v-for="(ePassword, index) in errors.password" :key="index">{{ePassword}}</li>
            </ul>
        </div>
        <div class="form-floating mb-4">
            <input type="password" id="mrCPassword" v-model="confirmPassword" class="text-input form-control" placeholder="confirm password" required>
            <label for="mrCPassword" class="small">Confrim Password</label>
            <ul>
                <li class="small text-danger" v-for="(eCPassword, index) in errors.confirmPassword" :key="index">{{eCPassword}}</li>
            </ul>
        </div>
        <div class="d-flex justify-content-center">
            <button class="text-white btn auth-btn" @click="handleSubmit" id="loginBtn">{{ signup }}</button>
        </div>
        <div class="my-3">
            Already registered ?
                <router-link to="/login" class="signup-text">Sign in</router-link>
        </div>
    </div>
</template>
<script>
export default {
    name: 'mobileRegister',
    data(){
        return {
            email: '',
            username: '',
            password: '',
            confirmPassword: '',
            signup: 'Create account',
            errors: [],
            message: null,
      }
    },

    methods:{
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
    },
}
</script>
<style scoped>
    .text-input{
        background: #f5f5f566;
        border: none;
    }
    .auth-btn{
        background: #DDA30E;
        border-radius: 4px;
        width: 50%;
    }
</style>