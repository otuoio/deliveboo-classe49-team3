<template>
    <div class="container">
        <div class="row row-cols-1 py-2">
            <div class="col">
                <form action="">
                    <div v-for="(category, index) in categories" :key="'category-'+index" class="form-check d-inline-block">
                        <input class="form-check-input mx-1" type="checkbox" name="categories[]" :value="category.name" :id="category.name" v-model="form.categories" @change="search">
                        <label class="form-check-label" :for="category.name">
                            {{ category.name }}
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div v-for="(user, index) in cards.users"
                :key="index">
                <RestaurantCard v-if="storageBoh.length == 0 || storage[0].userID == user.id" :user="user"/>
                <RestaurantCardModal v-else :user="user" data-bs-toggle="modal" data-bs-target="#exampleModal"/>
            </div>
        </div>
    </div>
</template>

<script>
import RestaurantCard from '../components/RestaurantCard.vue';
import RestaurantCardModal from '../components/RestaurantCardModal.vue';
import axios from 'axios';

export default {
    name: "Home",
    components: {
        RestaurantCard,
        RestaurantCardModal,
    },
    data() {
        return {
            categories: [],
            form: {
                    categories: []
                },
            differentUserID: false,
            storage: '',
            storageBoh: '',
        }
    },
    props: [
        'cards', 
    // 'inputSearch' -- SEARCHBAR
    ],
    created() {
        this.getCategories('http://127.0.0.1:8000/api/v1/categories');
        this.storage = JSON.parse(localStorage.getItem('cartDishes'));
        this.storageBoh = localStorage;
        console.log(this.storageBoh);
    },
    methods: {
        getCategories(url) {
            axios.get(url, {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}})
            .then((result) => {
                this.categories = result.data.results.data;
            });
        },
        search() {
            let url = "";
            if(this.form.categories.length == 0){
                url = "http://127.0.0.1:8000/api/v1/"
            } else if (this.form.categories.length == 1) {
                url = 'http://127.0.0.1:8000/api/v1/search?categories[]='+this.form.categories;
            } else {
                url = 'http://127.0.0.1:8000/api/v1/search?categories[]='+this.form.categories[0];
                for (let index = 1; index < (this.form.categories.length); index++) {
                    url += '&categories[]='+this.form.categories[index];
                }
            };

            axios
            .get(url, {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}, 
            )
            .then((result) => {

                this.cards.users = result.data.results.data;
            });
        },
        setUserID(id) {
            if(localStorage.getItem('RestaurantID') != id){
                return this.differentUserID = true;
            }else{
                return this.differentUserID = false;
            }
        },
    },
    watch: {
        // storage:function(value){
        //     value = localStorage.getItem('RestaurantID');
        //     console.log('ciao');
        // },
        // cards:function(value){
        //     value.forEach(element => {
        //         this.setUserID(element.user.id);
        //     });
        // }
        // inputSearch:function(value) {
        //     let url='http://127.0.0.1:8000/api/v1/searchName?inputSearch='+ value;
        //     axios
        //     .get(url, {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}, 
        //     )
        //     .then((result) => {
        //         console.log(url);
        //         this.cards.users = result.data.results.data;
        //         console.log(this.cards.users);
        //     });
        // },
    }

}
</script>

<style lang="scss" scoped>


</style>