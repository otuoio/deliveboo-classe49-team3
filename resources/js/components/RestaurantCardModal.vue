<template>

    <div>
        <div class="card card-span rounded-3">
            <img v-if="user.image" :src="'/storage/'+user.image" class="img-fluid rounded-3" :alt="user.name">
            <img v-else src="/storage/uploads/default/default_user.jpg" class="img-fluid rounded-3" :alt="user.name">
            <div class="card-body px-2 py-2">
            <h5 class="text-1000 text-truncate mb-1">{{ user.name }}</h5>
            <p class="text-1000 text-truncate mb-1"><i class="fa-solid fa-location-dot pe-1"></i>
                {{ user.address}}
            </p>
            <p class="shipment text-1000 text-truncate mb-1">Consegna: &euro; {{ user.shipment_price.toFixed(2) }}</p>
            </div>
            <div class="d-grid gap-2">
            </div>
        </div>
        <!-- <div class="card h-100 text-white card-has-bg click-col" :style="(user.image) ? {backgroundImage: `url(/storage/${user.image})`} : {backgroundImage:'url(/storage/uploads/default/default_user.jpg)'}">
            <img v-if="user.image" :src="'/storage/'+user.image" class="card-img" :alt="user.name">
            <img v-else src="/storage/uploads/default/default_user.jpg" class="card-img" :alt="user.name">
            <div class="card-img-overlay d-flex flex-column">
                <div class="card-body">
                    <h4 class="card-title mt-0 "><a class="text-white" herf="#">{{ user.name }}</a></h4>
                </div>
            </div>
        </div> -->

        <div class="modal fade" :id="`exampleModal${user.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Scegliendo un altro ristorante, il carrello esistente si svuoterà
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <div @click="refreshStorage">
                            <router-link class="btn btn-primary" :to="{ name: 'restaurant', params: { slug: user.slug }}" >Procedi
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
.wrapper{margin:10vh}
    //post card styles

    .card{
    border: none;
    transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
    overflow:hidden;
    // min-width: 290px;
    border-radius:20px;
    background-color: #fff;
    box-shadow: none;
    box-shadow: 8px 9px 12px -5px rgba(0,0,0,0.03);

    @media (max-width: 768px) {
    min-height:250px;
    }

    @media (max-width: 420px) {
    min-height:250px;
    }

    &.card-has-bg{
    transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
    background-size:120%;
    background-repeat:no-repeat;
    background-position: center center;
    &:before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: inherit;}

    &:hover {
        transform: scale(0.98);
        box-shadow: 0 0 5px -2px rgba(0,0,0,0.3);
        background-size:130%;
        transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);

        .card-img-overlay {
        transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
        background: rgba(167, 167, 167, 0.349);
        // background: linear-gradient(0deg, rgba(4,69,114,0.5) 0%, rgba(4,69,114,1) 100%);
        }
    }
    }
    .card-footer{
    background: none;
    border-top: none;
        .media{
        img{
        border:solid 3px rgba(234,95,0,0.3);
        }
    }
    }
    .card-meta{color:orange}
    .card-body{ 
        transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);

        p {
            color: #01678F;
            font-size: 0.9em;
        }

        .shipment {
            color:rgb(111, 111, 111);
        }
    }
    &:hover {
        box-shadow: rgb(0 0 0 / 7%) 0px 3px 6px, rgb(0 0 0 / 7%) 0px 3px 6px;
    .card-body{
        margin-top:0px;
        transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
        p {
            color: #01678F;
        }

        .shipment {
        color:rgb(111, 111, 111);
        }
    }
    cursor: pointer;
    transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
    }
    .card-img-overlay {
    transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
    background: rgb(119 119 119 / 66%);
    // background: linear-gradient(0deg, rgba(35,79,109,0.3785889355742297) 0%, rgba(69,95,113,1) 100%);
    }
    }
</style>