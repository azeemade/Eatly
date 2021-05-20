<template>
    <div>
        <div class="wrapper-container">
            <div class="row">
                <div class="a-sidenav">
                    <vendorSidenav />
                </div>
                <div class="container vMain mb-5">
                    <router-view></router-view>
                </div>
                <div class="vfooter">
                    <vfooter />
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .vMain{
        width: 100%;
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
    .a-sidenav{
        display: none;
    }
    .vfooter{
        overflow: hidden;
        position: fixed;
        bottom: 0;
        width: 100%;
        box-shadow: -1px -1px 1px rgba(32, 33, 36, 0.28);
        background-color: white;
    }
    
    @media only screen and (min-width: 768px) {
        .a-sidenav{
            display: block;
            position: fixed;
            z-index: 1;
            overflow-x: hidden;
            height: 100%;
            width: 200px;
            box-shadow: 0 1px 3px rgba(32, 33, 36, 0.28);
        }
        .vMain{
            width: 81%;
            margin-left: 16.666667%;
        }
        .vfooter{
            display: none
        }
     }
</style>
