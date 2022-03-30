<template>
    <div class="col">
        <div class="card h-100">
            <img v-if="user.image" :src="'/storage/'+user.image" class="card-img-top" :alt="user.name">
            <img v-else src="/storage/uploads//default/default.png" class="card-img-top" :alt="user.name">
            <div class="card-body">
                <h5 class="card-title">{{ user.name }}</h5>
            </div>
            <!-- <router-link class="btn btn-info" :to="{ name: 'user', params: { id: user.id }}">View</router-link> -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'RestaurantCard',
    props: ['user']
}
</script>

<style lang="scss" scoped>

</style>