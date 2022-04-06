<template>
    <div class="app-header header-shadow">
        
    </div>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            // searchRestaurant: '' --SEARCHBAR
        }
    },
    props: ['cards'],
    methods: {
        
    }
}
</script>

<style lang="scss" scoped>
.form-control:focus {
    box-shadow: 0 0 0 0.15rem rgba(165, 164, 164, 0.678);
}
</style>