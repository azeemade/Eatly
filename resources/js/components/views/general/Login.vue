<template>
    <div>
        <div class="desktop">
            <desktopLogin />
        </div>
        <div class="mobile">
            <mobile-login/>
        </div>
    </div>
</template>
<script>
import desktopLogin from '../assets/desktopLogin.vue';
import mobileLogin from '../assets/mobileLogin.vue';
export default {
    components: { 'mobileLogin': mobileLogin, 'desktopLogin': desktopLogin },

    created: function(){
        document.body.style.backgroundColor = "#EDE5C7"
    },

    destroyed: function(){
        document.body.style.backgroundColor = "null"
    },
}
</script>
<style>
    .desktop{
        display: none;
    }
    .mobile{
        display: block;
    }
    @media only screen and (min-width: 768px) {
        .mobile{
            display: none;
        }
        .desktop{
            display: block;
        }
    }
</style>
