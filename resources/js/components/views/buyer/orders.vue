<template>
    <div>
        <div class="d-flex justify-content-around mb-5">
            <div>
                <router-link to="/openOrders">Open Orders</router-link>
            </div>
            <div>
                <router-link to="/closedOrders">Closed Orders</router-link>
            </div>
        </div>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>