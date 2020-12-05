<template>
    <div>
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h1>Welcome back,</h1>
                    <p>Login to continue.</p>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <input type="email" placeholder="user@example.com" class="form-control" v-model="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="password" class="form-control" v-model="password" required>
                        </div>
                        <button class="btn-block btn btn-primary" @click="handleSubmit">Login</button>
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
                axios.post('api/login', {
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
                            if (role == "consumer" || role == "vendor"){
                                this.$router.push('/home')
                            }else{
                                if (role == "admin"){
                                    this.$router.push('/admin')
                                }
                            }
                        }
                    }
                })
                .catch(function (error){
                    console.error(error);
                });
            }
        }
    },
}
</script>
