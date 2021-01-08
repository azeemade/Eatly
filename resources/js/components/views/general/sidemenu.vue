<template>
    <div>
        <div class="d-inline-flex">
            <button type="button" class="close my-3 float-left text-danger btn ml-3" @click="closeMenu()"><span aria-hidden="true">&times;</span></button>
        </div>
        <div>
            <ul class="sidebar-i">
                <li class="mb-4">
                    <button class="btn btn-default" @click="closeMenu()">
                        <router-link to="/login">Login</router-link>
                    </button>
                </li>
                <li class="mb-4 btn">
                    <button class="btn btn-default" @click="closeMenu()">
                        <router-link to="/login">Signup</router-link>
                    </button>
                </li>
                <li class="mb-3 btn">Help</li><hr>
                <li class="mt-1 btn">
                    <button class="btn btn-default" @click="closeMenu()">
                        <router-link to="/register/vendor" class="reg">Become as food vendor</router-link>
                    </button>   
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        closeMenu(){
            document.getElementById('sidebar-content').style.display= "none";
        }
    },
}
</script>
<style>
    .sidebar-i{
        flex-direction: column;
        display: flex;
        justify-content: space-between;
        height: 100%;
        align-items: center;
    }
</style>