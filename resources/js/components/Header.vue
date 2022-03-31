<template>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input v-model="searchRestaurant" type="search" class="form-control text-white bg-dark" placeholder="Search..." aria-label="Search">
                    <button type="submit" @click.prevent="$emit('searchName', searchResturant)" class="btn btn-outline-primary">Cerca</button>    
                </form>
            </div>
        </div>
  </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            searchRestaurant: ''
        }
    },
    props: ['cards'],
    methods: {
        searchName() {
            this.cards.users.forEach((user) => {
            if (user.name.toLowerCase().includes(this.searchRestaurant.toLowerCase())) {
                user.show = 1;
            } else {
                user.show = 0;
            }
            });
        },
    }
}
</script>

<style lang="scss" scoped>
.form-control:focus {
    box-shadow: 0 0 0 0.15rem rgba(165, 164, 164, 0.678);
}
</style>