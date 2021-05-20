<template>
    <div>
        <div class="mb-3">
            <div>
                <div class="d-flex mx-1">
                    <input type="search" placeholder="Search for anything" class="form-control" v-model="search" >
                    <router-link :to="{ path: '/search/meal/?q='+search}" class="btn">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </router-link>
                </div>
                <!--<div id="search-content">
                    <search-result />
                </div>-->
            </div>
        </div>
        <p class="alert alert-danger alert-dismissible text-center " role="alert" v-bind:class="{hidden: message == null}">{{message}}</p>
        <div class="mb-3 px-2 search-card pb-2">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="search-text">RECENT</p>
                </div>
                <div>
                    <button class="btn clear-btn" data-toggle="modal" data-target=".clearModal">
                        Clear
                    </button>
                    <div class="modal fade bs-example-modal-sm clearModal" tabindex="-1" role="dialog" aria-labelledby="clearModal">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content px-3">
                                <div class="modal-body text-center">
                                    <p>Do you want to clear recent search</p>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-danger" data-dismiss="modal" @click="clearSearch">Yes</button>
                                        <button class="btn" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="mx-2 search-item-border mb-2" v-for="(search_r, index) in recent_search" :key="index">
                    <p  class="search-text">{{search_r.search_title}}</p>
                </div>
            </div>
        </div>
        <div class="mb-3 px-2 search-card pb-2">
            <div>
                <p class="search-text">POPULAR</p>
            </div>
            <div>
                <div class="mx-2 search-item-border mb-2" v-for="(search_p, index) in searchPop" :key="index">
                    <p  class="search-text">{{search_p.search_title}}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            searchPop: [],
            message: null,
            search: ''
        }
    },

    methods:{   
        clearSearch(){
            this.$store.dispatch('clearRecent', this.$store.state.id)
            this.$store.dispatch('fetchRecent', this.$store.state.id)
        },

        openSearch(){
            let id = this.$store.state.id;
            let search = this.search;

            document.getElementById("search-content").style.display = "block";
            this.$store.dispatch('storeSearch', {id, search})
            this.$store.commit('NEW_SEARCH', search)
        },
    },

    mounted(){
        this.$store.dispatch('fetchRecent', this.$store.state.id)


        axios.get(`http://127.0.0.1:8000/api/v1/search/popular`)
        .then(response => this.searchPop = response.data.data)

        
    },

    computed: {
        ...mapGetters([
            'recent_search'
        ])
    }
}
</script>
<style scoped>
    .search-card{
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
        border-radius: 4px;
    }
    .search-text{
        color: #A98402;

    }
    .clear-btn:hover{
        color: #A98402;
        border: 1px solid #A98402;
        background-color: transparent;
    }
    .search-item-border{
        border-bottom: 1px solid #C4C4C4;
    }
    #search-content{
        display: none;
        width: 100%;
        overflow-y: auto;
        position: fixed;
        z-index: 1;
        right: 0;
        background-color: white;
        transition: 0.5s;
        border-radius: 20px 0px 20px 0px;
        height: 100%;
    }

</style>