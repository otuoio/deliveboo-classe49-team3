<template>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <Header 
        :cards="cards"
        @searchName="find($event)"
        />
        <router-view 
        :cards="cards"
        :inputSearch="inputSearch"
        >
        </router-view>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

import Axios from "axios";
export default {
    name: "App",
    components: {
        Header,
        Footer
    },
    emits: ['searchRestaurant'],
    data() {
        return {
            cards: {
                users: [],
                // next_page_url: null,
                // prev_page_url: null
            },
            inputSearch: "",
        }
    },
    created(){
        this.getUsers('http://127.0.0.1:8000/api/v1/');
    },
    methods: {
        find(value) {
            this.inputSearch = value;
        },
        // changePage(vs) {
        //     let url = this.cards[vs];
        //     if(url) {
        //     this.getPosts(url);
        //     }
        // },
        getUsers(url){
            Axios.get(url, {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}).then(
                (result) => {
                this.cards.users = result.data.results.data;
                // this.cards.next_page_url = result.data.results.next_page_url;
                // this.cards.prev_page_url = result.data.results.prev_page_url;
                });
        },
    }
}
</script>

<style lang="scss" scoped>

</style>