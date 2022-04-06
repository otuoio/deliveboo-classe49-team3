<template>
    <div class="app-main">
        <div class="header__pane">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar" @click="getSelector()">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div> 
            <div class="scrollbar-sidebar ps">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu metismenu">
                        <li class="app-sidebar__heading">Categorie</li>
                        <li v-for="(category, index) in categories" :key="'category-'+index" class="form-check p-0">
                            <input class="form-check-input mx-1" type="checkbox" name="categories[]" :value="category.name" :id="category.name" v-model="form.categories" @change="search">
                                <label class="form-check-label text-capitalize" :for="category.name">
                                    {{ category.name }}
                                </label>
                        </li>
                    </ul>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
        <!-- /sidebar -->
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <RestaurantCard :user="user"
                    v-for="(user, index) in cards.users" 
                    :key="index"/>
                </div>
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
            userID: ''
        }
    },
    props: [
        'cards', 
    // 'inputSearch' -- SEARCHBAR
    ],
    created() {
        this.getCategories('http://127.0.0.1:8000/api/v1/categories');
        // this.storage = JSON.parse(localStorage.getItem('cartDishes'));
        // this.storageBoh = localStorage;
        // console.log(this.storageBoh);
        // for (let i = 0; i < localStorage.length; i++) {
        //     const element = array[i];
            
        // }
        this.storage = localStorage;
        if (localStorage.length > 0) {
            let key = localStorage.key(0);
            this.userID = JSON.parse(localStorage.getItem(key)).userID;
        }
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