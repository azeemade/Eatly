<template>
    <div>
        <navbar />
        <div>
            <account />
            <vSideMenu />
        </div>
        <div class="myMain">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style>
    a {
        color: black;
    }
    a:hover {
        color: black;
        text-decoration: none;
    }
    li{
        list-style: none;
    }
    .myMain{
        margin-top:71px;
        width: 100%;
    }
</style>