<template>
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <form action="">
                    <div v-for="(category, index) in categories" :key="'category-'+index" class="form-check d-inline-block">
                        <input class="form-check-input mx-1" type="checkbox" name="categories[]" :value="category.name" :id="category.name" v-model="form.categories">
                        <label class="form-check-label" :for="category.name">
                            {{ category.name }}
                        </label>
                    </div>
                    <button class="btn btn-info d-block m-3" @click.prevent="search(form.categories)" >Sort</button>
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
                console.log(this.categories);
            });
        },
        search(parameters) {
            axios
            .get('http://127.0.0.1:8000/api/v1/search', {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}, {params: parameters})
            .then((result) => {
                console.log(result.data.count);
                this.cards.users = result.data.results;
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