<template>
    <div v-if="preview == null">
        <div class="image-section">
            <div>
                <div v-if="editingMode == true">
                    <img :src="image" width="115" height="115" class="d-block" onerror="arguments[0].currentTarget.style.display='none'" />
                </div>
                <div v-else>
                    <img :src="preview" width="115" height="115" onerror="arguments[0].currentTarget.style.display='none'" />
                </div>
            </div>
            <div class="image-add">
                <label for="file"  class="btn image-overlay-icon">
                    <input type="file" id="file" name="masterImage" autocomplete="off" @change="attach_image" class="hidden">
                    <i class="bi bi-plus" style="font-size: xxx-large"></i>
                </label>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="image-section">
            <div>
                <img :src="preview" width="115" height="115" alt=" "/>
            </div>
            <div class="image-overlay">
                <label for="file"  class="btn image-overlay-icon">
                    <input type="file" id="file" name="masterImage" autocomplete="off" @change="attach_image" class="hidden">
                    <i class="bi bi-plus" style="font-size: xxx-large"></i>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        editingMode: {
            type: Boolean,
            default: false
        },
        image: {
            type: String,
            default: ''
        }
    },
    data(){
        return{
           preview: null
        }
    },
    methods: {
        attach_image(e) {
            var files = e.target.files
            var files_ = files[0]
            this.$store.commit('SET_MASTER_IMAGE', files_)
            console.log(files_)

            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var reader = new FileReader();
            reader.onload = (e) => {
                this.preview = e.target.result;
            };

            reader.readAsDataURL(file);
        },
    },
}
</script>
<style>
    .image-section{
        width: 115px;
        height: 115px;
        position: relative;
        background-color: rgb(239, 239, 239);
    }

    .image-overlay{
        position: absolute;
        width: 115px;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        opacity: 0;
        background-color: #000;
        transition: .3s ease;
    }
    .image-add{
        position: absolute;
        width: 115px;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        opacity: 0.2;
        background-color: #000;
        transition: .3s ease;
    }
    .image-section:hover .image-overlay{
        opacity: 0.2;
    }

    .image-overlay-icon {
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }
</style>