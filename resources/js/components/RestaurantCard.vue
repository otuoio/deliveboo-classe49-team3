<template>
    <div class="col" @click="refreshStorage">
        <router-link class="text-decoration-none text-black" :to="{ name: 'restaurant', params: { id: user.id }}">
            <div class="card h-100">
                <img v-if="user.image" :src="'/storage/'+user.image" class="card-img-top" :alt="user.name">
                <img v-else src="/storage/uploads/default/default_user.jpg" class="card-img-top" :alt="user.name">
                <div class="card-body">
                    <h5 class="card-title">{{ user.name }}</h5>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>
export default {
    name: 'RestaurantCard',
    props: ['user'],
    methods: {
        refreshStorage() {
            if(localStorage.getItem('RestaurantID') != this.user.id){
                alert('Scegliendo un altro ristorante, il carrello esistente si svuoterà');
                localStorage.clear();
                console.log('ciao');
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>