<template>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div :class="(user.show !== 1)? 'd-none' : '' " class="col" v-for="(user, index) in cards.users" :key="index">
                <div class="card h-100">
                    <img v-if="user.image" :src="'/storage/'+user.image" class="card-img-top" :alt="user.name">
                    <img v-else src="/storage/uploads//default/default.png" class="card-img-top" :alt="user.name">
                    <div class="card-body">
                        <h5 class="card-title">{{ user.name }}</h5>
                    </div>
                    <!-- <router-link class="btn btn-info" :to="{ name: 'user', params: { id: user.id }}">View</router-link> -->
                </div>
            </div>
        </div>
        <!-- <div class="row mt-3 bg-light" v-if="cards.prev_page_url || cards.next_page_url">
            <ul class="list-inline bg-light d-flex justify-content-center">
                <li class="list-inline-item"> <button v-if="cards.prev_page_url" class="btn btn-primary" @click="changePage('prev_page_url')">Prev</button></li>
                <li class="list-inline-item"> <button v-if="cards.next_page_url" class="btn btn-primary" @click="changePage('next_page_url')">Next</button></li>
            </ul>
        </div> -->
    </div>
</template>

<script>

export default {
    name: "Home",
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