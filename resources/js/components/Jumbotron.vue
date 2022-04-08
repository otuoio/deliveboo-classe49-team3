<template>
    <section class="jumbotron overflow-hidden bg-primary">
        <div class="container">
            <div class="row flex-center">
                <div class="col-md-7 col-lg-6 pt-5 pt-md-0 text-md-start text-center d-flex flex-column justify-content-center">
                    <h1 class="fs-md-5 fs-xl-6 text-light">Non ci vedi pi&ugrave; dalla fame?</h1>
                    <h1 class="text-800 fs-4">Trova i ristoranti vicino a te <br class="d-none d-xxl-block">con un solo click</h1>
                </div>
                <div class="col-md-5 col-lg-6 pt-5 img-container">
                    <img class="img-fluid" src="https://technext.github.io/foodwagon/v1.0.0/assets/img/gallery/hero-header.png" alt="hero-header">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Jumbotron",
}
</script>

<style lang="scss" scoped>
.jumbotron {
    height: 400px;
    margin-top: 60px;

    h1.text-light{
        font-weight: 700;
        color: #F9FAFD !important;
    }

    .img-container {
        height: 400px;
    }
}
</style>