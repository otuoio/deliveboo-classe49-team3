<template>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <RestaurantCard :user="user"
            :class="(user.show !== 1)? 'd-none' : '' "
            v-for="(user, index) in cards.users" 
            :key="index"/>
        </div>
    </div>
</template>

<script>
import RestaurantCard from '../components/RestaurantCard.vue'

export default {
    name: "Home",
    components: {
        RestaurantCard
    },
    props: ['cards', 'inputSearch'],
    methods: {
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