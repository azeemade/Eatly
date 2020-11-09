<template>
    <div>
        <div class="wrapper-container">
            <div class="row">
                <div class="col-md-2 py-3">
                    <vendorSidenav />
                </div>
                <div class="col-md-10 main mt-5">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .main{
        margin-left: 16.666667%;
    }
    .wrapper-container{
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    .col-md-2.py-3{
        position: fixed;
        z-index: 1;
        overflow-x: hidden;
        background-color: #f5f5f5;
        height: 100%;
    }
</style>
