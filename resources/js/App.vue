<template>
    <div>
        <navbar />
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
    a{
        color: black;
    }
    li{
        list-style: none;
    }
    .myMain{
        margin-top:56px;
    }
</style>