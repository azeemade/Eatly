<template>
    <div>
        <div class="wrapper-container">
            <div class="row">
                <div class="col-md-2 py-3">
                    <sidenav />
                </div>
                <div class="col-md-10 main mt-5">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    li.btn:hover{
        background-color: #707070;
    }
    li.btn:active{
        list-style: none;
        color: #707070;
    }
    .col-md-7 .card{
        background-color: rgba(254, 237, 0, 0.74);
        border: none;
        border-radius: 7px;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
    }
    .col-md-5 .card{
        background-color:rgb(226, 226, 226);
        border: none;
        border-radius: 7px;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.16);
    }
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



