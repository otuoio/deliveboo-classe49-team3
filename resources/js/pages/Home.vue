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
            <RestaurantCard :user="user"
            :class="(user.show !== 1)? 'd-none' : '' "
            v-for="(user, index) in cards.users" 
            :key="index"/>
        </div>
    </div>
</template>

<script>
import RestaurantCard from '../components/RestaurantCard.vue';
import axios from 'axios';

export default {
    name: "Home",
    components: {
        RestaurantCard
    },
    data() {
        return {
            categories: [],
            form: {
                    categories: []
                },
        }
    },
    props: ['cards', 'inputSearch'],
    created() {
        this.getCategories('http://127.0.0.1:8000/api/v1/categories');
        
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
                // this.cards.prevPage = result.data.results.prev_page_url;
                // this.cards.nextPage = result.data.results.next_page_url;
                // console.log(this.cards.users);
            });
        }
    },
    watch: {
        inputSearch:function(value) {
            this.cards.users.forEach((user) => {
            if (user.name.toLowerCase().includes(value.toLowerCase())) {
                user.show = 1;
                console.log(user.show);
            } else {
                user.show = 0;
                console.log(user.show);
            }
            });
        },
    }

}
</script>

<style lang="scss" scoped>


</style>