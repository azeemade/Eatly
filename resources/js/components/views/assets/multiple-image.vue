<template>
    <div class="d-flex align-items-baseline">
        <div class="image-section mr-2" v-show="count <= 2 || count_ <= 2">
            <div>
                <img width="50" height="50" onerror="arguments[0].currentTarget.style.display='none'" />
            </div>
            <div class="image-add">
                <label for="fileList"  class="btn image-overlay-icon">
                    <input type="file" id="fileList" autocomplete="off" multiple @change="attachImage" class="hidden">
                    <i class="bi bi-plus" style="font-size: x-large"></i>
                </label>
            </div>
        </div>
        <div v-if="editingMode == true" class="d-flex">
            <div class="mr-2 border" name="images[]" v-for="(img, index) in imageList" :key="index">
                <img :src="'/images/meal/'+ img.url" width="75" height="75" onerror="arguments[0].currentTarget.style.display='none'" />
                <span class="d-flex input-group-btn align-items-center justify-content-end">
                    <button class="btn"  @click="remove(index)">
                        <i class="bi bi-trash mr-1 text-danger"></i>
                    </button>
                </span>
            </div>
        </div>
        <div v-else class="d-flex">
            <div class="mr-2 border" name="images[]" v-for="(prev, index) in previewList" :key="index">
                <img :src="prev" width="75" height="75" onerror="arguments[0].currentTarget.style.display='none'" />
                <span class="d-flex input-group-btn align-items-center justify-content-end">
                    <button class="btn"  @click="remove(index)">
                        <i class="bi bi-trash mr-1 text-danger"></i>
                    </button>
                </span>
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
        imageList: {
            type: Object,
        }
    },
    name: "multiple-images",
    data(){
        return{
            images: [],
            count: null,
            previewList: [],
            count_: null
        }
    },

    methods:{
        attachImage(event){
            let files = event.target.files;

            for(let i=0; i < files.length; i++){
                this.images.push(files[i]);
                this.$store.commit('SET_IMAGES', files[i])

                this.createImage(files[i]);
            }

            this.count = this.images.length;
            console.log(this.images)           
        },

        createImage(file) {
            var reader = new FileReader();
            reader.onload = (e) => {
                this.previewList.push(e.target.result);
            };

            reader.readAsDataURL(file);
        },

        remove(index){
            if (editingMode == true){
                this.$store.commit('REMOVE_FROM_IMAGES', index)
                this.count_ = this.$store.state.selectedmeal_image.length
            }
            else{
                this.images.splice(index, 1)
                this.previewList.splice(index, 1)
                this.$store.commit('REMOVE_IMAGE', index)
                this.count = this.images.length
            }
        },

        mounted(){
            this.count_ = this.$store.state.selectedmeal_image.length
        }

    }
}
</script>
<style scoped>
    .image-section{
        width: 50px;
        height: 50px;
    }
    .image-add{
        width: 50px;
        height: 50px;
    }
</style>