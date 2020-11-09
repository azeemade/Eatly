<template>
    <div>
        <div>
            <div class="hero-image">
                <div class="hero-text">
                    <h1 style="font-size:50px">You hungry</h1>
                    <p>Find the closest food vendor to you.</p>
                    <button class="btn-dark btn">Explore</button>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .hero-image{
    /*    background-image: url("../../../../../public/images/bermuda-food-delivery-2.png");*/
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        width: 1366px;
        height: 450px;
    }
    .hero-text{
        text-align: left;
        position: absolute;
        top: 50%;
        left: 30%;
        transform: translate(-50%, -50%);
        color: black;
    }
</style>