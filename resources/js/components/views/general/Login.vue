<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img :src="'/images/loginImage.png'" alt="" width="100%" height="auto" class="rounded">
                </div>
                <div class="col-md-6 login-section p-5">
                    <h1 style="font-weight:100;">Welcome back,</h1>
                    <p>Login to continue.</p>
                    <form>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" v-model="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" v-model="password" required>
                        </div>
                        <button class="btn-link btn">Forgotten password ?</button>
                        <button class="btn float-right" @click="handleSubmit">Login</button>
                        <div class="mt-5 d-flex align-items-baseline">
                            <p>No account yet ???</p>
                            <button class="btn-link btn">Create account </button>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
        data(){
        return {
            email: '',
            password: '',
      }
    },

    methods:{
        handleSubmit(e) {
            e.preventDefault()

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
                .catch(error => {
                    console.log(error)
                    })
            }
        }
    },
}
</script>
<style>
    div.form-group input{
        border: none;
        border-bottom: 1px solid;
        background-color: whitesmoke;
    }
    div.form-group label{
        opacity: 1;
        font-size: smaller;
    }
    .login-section{
        border-radius: 1rem;
        background-color: #f5f5f5;
        margin-top: 3rem;
    }
    .login-section button.btn.float-right{
        float: right;
        background-color: #ffdb00;
    }
</style>
