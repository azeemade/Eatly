<template>
    <div>
        <div class="desktop">
            <desktop-register />
        </div>
        <div class="mobile">
            <mobile-register />
        </div>
    </div>
</template>
<script>
import desktopRegister from '../assets/desktopRegister.vue';
import mobileRegister from '../assets/mobileRegister.vue';
export default {
    components: { mobileRegister, desktopRegister },

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
