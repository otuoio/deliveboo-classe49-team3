<template>
    <div>
        <Main :cards="cards"></Main>
    </div>
</template>

<script>
import Main from '../components/Main.vue';

export default {
    name: "Home",
    components: {
        Main
    },
    props: ['cards']


}
</script>

<style lang="scss" scoped>

</style>