<template>
    <div>
        <div class="header__pane">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar" @click="getSidebar()">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>

        <div class="app-main">
            <!-- Sidebar -->
            <div class="app-sidebar sidebar-shadow">
                <div class="scrollbar-sidebar ps">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu metismenu">
                            <li class="app-sidebar__heading">Categorie</li>
                            <li v-for="(category, index) in categories" :key="'category-'+index" class="form-check p-0 pb-1">
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
                <section class="jumbotron overflow-hidden bg-primary">
                    <div class="container">
                        <div class="row flex-center">
                            <div class="col-md-7 col-lg-6 pt-5 pt-md-0 text-md-start text-center d-flex flex-column justify-content-center">
                                <h1 class="fs-md-5 fs-xl-6 text-light">Non ci vedi pi&ugrave; dalla fame?</h1>
                                <h1 class="text-800 fs-4">Trova i ristoranti vicino a te <br class="d-none d-xxl-block">con un solo click</h1>
                            </div>
                            <div class="col-md-5 col-lg-6 pt-5 img-container">
                                <img class="img-fluid" src="https://technext.github.io/foodwagon/v1.0.0/assets/img/gallery/hero-header.png" alt="hero-header">
                            </div>
                        </div>
                    </div>
                </section>
                <div class="app-main__inner">
                    <div class="row gx-3 h-100 align-items-center">
                        <div class="col-sm-6 col-xl-4 col-xxl-3 mb-5 h-100" v-for="(user, index) in cards.users"
                        :key="index">
                            <RestaurantCard v-if="storage.length == 0 || userID == user.id" :user="user"/>
                            <RestaurantCardModal v-else :user="user" data-bs-toggle="modal" :data-bs-target="`#exampleModal${user.id}`"/>
                        </div>
                    </div>
                    <!-- <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 g-4">
                        <div v-for="(user, index) in cards.users"
                        :key="index">
                            <RestaurantCard v-if="storage.length == 0 || userID == user.id" :user="user"/>
                            <RestaurantCardModal v-else :user="user" data-bs-toggle="modal" :data-bs-target="`#exampleModal${user.id}`"/>
                        </div>
                    </div> -->
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
            userID: '',
            sidebar: '',
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
        getSidebar(){
            this.sidebar = document.querySelector('.app-sidebar');
            console.log(this.sidebar);
            if(this.sidebar.classList.contains('mobile-in')){
                this.sidebar.classList.remove('mobile-in');
            }else{
                this.sidebar.classList.add('mobile-in');
            }
        }
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

.jumbotron {
    height: 400px;

    h1.text-light{
        font-weight: 700;
        color: #F9FAFD !important;
    }

    .img-container {
        height: 400px;
    }
}

.py-8 {
    padding-top: 7.5rem !important;
    padding-bottom: 7.5rem !important;
}


.text-800 {
    color: white !important;
    font-weight: 400;
}


.fs-4 {
    font-size: 2.0736rem !important;
}

.bg-primary {
    background-color: #FFB30E !important;
}

.fs-md-5 {
    font-size: 2.48832rem;
}

.header__pane {
    position: fixed;
    z-index: 20;
    left: 25px;
    top: 30px;
    transform: translateY(-50%);
    .hamburger-box {
        vertical-align: text-bottom;
    }
}

@media (min-width: 1200px) {
    .fs-xl-6 {
        font-size: 2.98598rem;
    }
}

@media (max-width: 991.98px) {
    .app-sidebar {
        transform: translateX(-280px);
    }
    .mobile-in {
        transform: translateX(0);
    }
}

@media (min-width: 991.98px) {
    .header__pane {
        display: none;
    }
}

@media (min-width: 768px){
    .text-md-start {
        text-align: left !important;
    }
}

.fixed-sidebar .app-main .app-main__outer {
    z-index: 9;
    padding-left: 250px;
    width: 100vw;
}

.app-sidebar {
    width: 250px;
    display: flex;
    z-index: 11;
    overflow: hidden;
    min-width: 250px;
    // position: relative;
    flex: 0 0 250px;
    margin-top: -60px;
    padding-top: 60px;
    transition: all .2s;

    .app-sidebar__heading {
    text-transform: uppercase;
    font-size: 1rem;
    margin: 0.75rem 0;
    color: #01678F;
    font-weight: 700;
    white-space: nowrap;
    position: relative;
    }


    label {
        font-size: 1rem;
    }

    .form-check-input:checked {
        background-color: #01678F;
        border-color: #01678F;
    }  
    
    .form-check-input:focus{
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.25);
    }
}

</style>