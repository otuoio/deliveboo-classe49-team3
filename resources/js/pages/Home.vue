<template>
    <div class="padding-60">
        <div class="header__pane">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar" @click="getSidebar()">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <Jumbotron></Jumbotron>
        <div class="app-main d-flex p-0">
            <!-- Sidebar -->
            <div class="app-sidebar sidebar-shadow p-0">
                <div class="scrollbar-sidebar ps">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu metismenu">
                            <li class="app-sidebar__heading">Tipi di cucina</li>
                            <li v-for="(category, index) in categories" :key="'category-'+index" class="form-check p-0">
                                <input class="form-check-input mx-1 me-3" type="checkbox" name="categories[]" :value="category.name" :id="category.name" v-model="form.categories" @change="search">
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
                    <!-- I RISTORANTI PIU POPOLARI  -->
                    <div class="row gx-3">
                        <span class="row-title">
                            I pi&ugrave; richiesti
                        </span>
                        <div class="col-sm-6 col-xl-4 col-xxl-3 mb-5" v-for="(user, index) in mostPopular"
                        :key="index">
                            <RestaurantCard v-if="storage.length == 0 || userID == user.id" :user="user"/>
                            <RestaurantCardModal v-else :user="user" data-bs-toggle="modal" :data-bs-target="`#exampleModal${user.id}`"/>
                            <div class="popular-tag">POPULAR</div>
                        </div>
                    </div>
                    <!-- TUTTI I RISTORANTI -->
                    <div class="row gx-3">
                        <span class="row-title">
                            Tutti i ristoranti
                        </span>
                        <div class="col-sm-6 col-xl-4 col-xxl-3 mb-5" v-for="(user, index) in cards.users"
                        :key="index">
                            <RestaurantCard v-if="storage.length == 0 || userID == user.id" :user="user"/>
                            <RestaurantCardModal v-else :user="user" data-bs-toggle="modal" :data-bs-target="`#exampleModal${user.id}`"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import RestaurantCard from '../components/RestaurantCard.vue';
import RestaurantCardModal from '../components/RestaurantCardModal.vue';
import Jumbotron from '../components/Jumbotron.vue';
import axios from 'axios';

export default {
    name: "Home",
    components: {
    Jumbotron,
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
            mostPopular: []
        }
    },
    props: [
        'cards', 
    // 'inputSearch' -- SEARCHBAR
    ],
    created() {
        this.getCategories('http://127.0.0.1:8000/api/v1/categories');
        this.getPopular()
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
        getPopular(){
            axios.get('http://127.0.0.1:8000/api/v1/popular', {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}).then(
                (result) => {
                    // array che contiene i dati degli ordini con annessi dati utente
                    let populars = result.data.results.data;
                    
                    let popularsRanked = [];

                    populars.forEach((element) => {
                        let count = 0
                        for (let i = 0; i < populars.length; i++) {
                            if (element.id == populars[i].id) {
                                count++;
                            }
                        }
                        element['rank'] = count;
                        popularsRanked.push(element);
                    });

                    // array che contiene tutti gli ogetti con id e rank (senza duplicati)
                    let uniquePopularsRanked = [...popularsRanked.reduce((map, obj) => map.set(obj.id, obj), new Map()).values()];

                    // array ordinato per rank decrescente
                    let mostPopularObjs = uniquePopularsRanked.sort((a, b) => b.rank-a.rank);

                    // array che contiene i 4 rist più popolari
                    this.mostPopular = mostPopularObjs.slice(0, 4);;
                    console.log(this.mostPopular);
                    

                }
            );
                
        },
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
                setTimeout(() => {
                    this.sidebar.classList.remove('transition');
                }, 300);
            }else{
                this.sidebar.classList.add('mobile-in');
                this.sidebar.classList.add('transition');
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
.popular-tag {
    padding: 0.3rem;
    position: absolute;
    top: 12px;
    left: -5px;
    font-weight: 800;
    font-size: 0.8rem;
    color: #01678F;
    transform: rotate(-45deg);
    background: rgb(229, 226, 226);
    border-radius: 15px 0 15px 0;
    box-shadow: -1px -1px 3px;
}
.padding-60 {
    padding-top: 60px;
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

.transition {
    transition: all .2s !important;
}

// @media (max-width: 990.98px){
//     .app-sidebar{
//         transition: all .2s !important;
//     }
// }

@media (max-width: 991.98px) {
    .app-sidebar {
        transform: translateX(-280px);
        position: fixed !important;
        top: 60px !important;
    }
    .mobile-in {
        transform: translateX(0);
    }

    .app-main__outer{
        width: calc(100% + 250px) !important;
        padding: 0 !important;
    }
}

@media (min-width: 991.98px) {
    .header__pane {
        display: none;
    }

    .app-sidebar {
        position: sticky !important;
        top: 60px !important;
        padding-top: 0 !important;
        height: 100vh;
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
    top: 0;
    left: 0;
    z-index: 10;
    overflow: hidden;
    min-width: 250px;
    // position: relative;
    flex: 0 0 250px;
    margin-top: 0;
    transition: none;
    height: calc(100vh - 60px);

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

    .form-check {
        border-bottom: 1px solid #01678f27;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
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

.app-main__outer{
    padding: 0 !important;
    z-index: auto !important;
}

.hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
    background-color: #CB3F5A;
}

.row-title {
    font-size: 1.5rem;
    font-weight:700;
    padding-left: 15px;
    color: #CB3F5A;
    margin-bottom: 1em;
}

</style>