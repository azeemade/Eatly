<template>
    <div>
        <div class="wrapper-container">
            <div class="row">
                <div class="a-sidenav">
                    <sidenav />
                </div>
                <div class="main container mb-5">
                    <router-view></router-view>
                </div>
                <div class="footer">
                    <footernav />
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .main{
        width: 100%;
    }
    .wrapper-container{
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    .a-sidenav{   
        display: none;
    }
    .footer{
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
        .main{
            width: 81%;
            margin-left: 16.666667%;
        }
        .footer{
            display: none
        }
    }
</style>