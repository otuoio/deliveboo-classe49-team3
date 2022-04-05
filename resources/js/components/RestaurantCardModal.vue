<template>
    <div class="col">
        <div class="card h-100">
            <img v-if="user.image" :src="'/storage/'+user.image" class="card-img-top" :alt="user.name">
            <img v-else src="/storage/uploads/default/default_user.jpg" class="card-img-top" :alt="user.name">
            <div class="card-body">
                <h5 class="card-title">{{ user.name }}</h5>
            </div>
        </div>

        <div class="modal fade" :id="`exampleModal${user.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Scegliendo un altro ristorante, il carrello esistente si svuoterà
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <div @click="refreshStorage">
                            <router-link class="btn btn-primary" :to="{ name: 'restaurant', params: { id: user.id }}" >Procedi
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RestaurantCard',
    props: ['user'],
    methods: {
        refreshStorage() {
            localStorage.clear();
            
        },
    }
}
</script>

<style lang="scss" scoped>

</style>