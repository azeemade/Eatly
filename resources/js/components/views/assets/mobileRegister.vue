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
            <span class="small text-danger">{{vEmail}}</span>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="mrUsername" v-model="username" class="text-input form-control" placeholder="cactusflower1920" required>
            <label for="mrUsername" class="small">Username</label>
            <span class="small text-danger">{{vUsername}}</span>
        </div>
        <div class="form-floating mb-3">
            <input type="password" id="mrPassword" v-model="password" class="text-input form-control  mb-3" placeholder="password" required>
            <label for="mrPassword" class="small">Password</label>
            <span class="small text-danger">{{vPassword}}</span>
        </div>
        <div class="form-floating mb-4">
            <input type="password" id="mrCPassword" v-model="confirmPassword" class="text-input form-control" placeholder="confirm password" required>
            <label for="mrCPassword" class="small">Confrim Password</label>
            <span class="small text-danger">{{vCPassword}}</span>
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
            vEmail: '',
            vUsername: '',
            vPassword: '',
            vCPassword: '',
      }
    },

    methods:{
        handleSubmit(e) {
            e.preventDefault();

            if (this.email == '')
                this.vEmail = 'Email cannot be empty'
            else if(this.username == '')
                this.vUsername = 'Username cannot be empty'
            else if(this.password == '')
                this.vPassword = 'Password cannot be empty'
            else if(this.confirmPassword == '' || this.confirmPassword != this.password)
                this.vCPassword = 'Passwords do not match'
            else{
                this.vEmail = this.vUsername = this.vPassword = this.vPassword = ''
                this.signup = 'Creating account...'
            }
            /**document.getElementById("loginBtn").disabled = true;
            


            if (this.password.length > 0) {
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
                .catch(error => {
                    console.log(error)
                    })
            }**/
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