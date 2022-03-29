<template>
    <div>
        <Main :cards="cards"></Main>
    </div>
</template>

<script>
import Axios from "axios";
import Main from '../components/Main.vue';

export default {
    name: "Home",
    components: {
        Main
    },
    data() {
        return {
            cards: {
                users: null,
                // next_page_url: null,
                // prev_page_url: null
            }
        }
    },
    created(){
        this.getUsers('http://127.0.0.1:8000/api/v1/');
    },
    methods: {
        // changePage(vs) {
        //     let url = this.cards[vs];
        //     if(url) {
        //     this.getPosts(url);
        //     }
        // },
        getUsers(url){
            Axios.get(url, {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}).then(
                (result) => {
                console.log(result);
                this.cards.users = result.data.results.data;
                // this.cards.next_page_url = result.data.results.next_page_url;
                // this.cards.prev_page_url = result.data.results.prev_page_url;
                });
        }
        
        }


}
</script>

<style lang="scss" scoped>

</style>