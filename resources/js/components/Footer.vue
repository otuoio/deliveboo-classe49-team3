<template>
    <div class="container-fluid">
        <div class="container py-4">
            <div class="row w-100 m-0 justify-content-center align-items-center">
                <div class="col-12 col-lg-3">
                    <div class="logo">
                        <div class="body">
                        <span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <div class="base">
                            <span></span>
                            <div class="face"></div>
                        </div>
                        </div>
                        <h1 class="mb-0 d-none d-lg-block">Deliveboo</h1>
                    </div>
                </div>
                <div class="col-12 col-lg-9 mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-12 col-md-6 col-xxl-3 mt-2 mt-md-0 profile p-0">
                            <div class="text-md-center text-center text-lg-end text-xxl-start">
                                <span>
                                Mario Coppola
                                </span>
                                <a target="_blank" href="https://www.linkedin.com/in/mariocoppola91">
                                <i class="px-2 fa-brands fa-linkedin"></i>
                                </a><a target="_blank" href="https://github.com/otuoio">
                                <i class="pe-2 fa-brands fa-github"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xxl-3 mt-2 mt-md-0 profile p-0">
                            <div class="text-md-center text-center text-lg-end text-xxl-start">
                                <span>
                                    Sara Grigolin
                                </span> 
                                <a target="_blank" href="https://www.linkedin.com/in/grigolin-sara">
                                <i class="px-2 fa-brands fa-linkedin"></i>
                                </a><a target="_blank" href="https://github.com/saragrigolin">
                                <i class="pe-2 fa-brands fa-github"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xxl-3 mt-2 mt-md-0 profile p-0">
                            <div class="text-md-center text-center text-lg-end text-xxl-start">
                                <span>
                                    Luca Martinelli
                                </span>
                                <a target="_blank" href="https://www.linkedin.com/in/martinelliluca">
                                <i class="px-2 fa-brands fa-linkedin"></i>
                                </a><a target="_blank" href="https://github.com/luega">
                                <i class="pe-2 fa-brands fa-github"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xxl-3 mt-2 mt-md-0 profile p-0">
                            <div class="text-md-center text-center text-lg-end text-xxl-start">
                                <span>
                                    Francesco Ostellari
                                </span>
                                <a target="_blank" href="https://www.linkedin.com/in/francesco-ostellari">
                                <i class="px-2 fa-brands fa-linkedin"></i>
                                </a><a target="_blank" href="https://github.com/Francesco-Ostellari">
                                <i class="pe-2 fa-brands fa-github"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Footer",
}
</script>

<style lang="scss" scoped>
.container-fluid {
    background-color: #2F4858;
    color: white;
    z-index: 20;
    font-size: 1.1em;
    // font-weight: 500;
    i {
        color: white;
        font-size: 1.3em;
    }
    a {
        color: white;
        font-size: 0.9em;
        font-weight: normal;
    }
    span {
        padding-right: 5px;
    }
}

/* logo */

.logo {
    transform: scale(0.7);
}
.body {
    position: absolute;
    top: 50%;
    margin-left: -50px;
    // margin-left: -145px;
    // left: 50%;
    // animation: speeder 1s linear infinite;
}
.body > span {
    height: 5px;
    width: 35px;
    background: white;
    position: absolute;
    top: -19px;
    left: 60px;
    border-radius: 2px 10px 1px 0;
}
.base span {
    position: absolute;
    width: 0;
    height: 0;
    border-top: 6px solid transparent;
    border-right: 100px solid white;
    border-bottom: 6px solid transparent;
}
.base span:before {
    content: "";
    height: 22px;
    width: 22px;
    border-radius: 50%;
    background: white;
    position: absolute;
    right: -110px;
    top: -16px;
}
.base span:after {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border-top: 0 solid transparent;
    border-right: 55px solid white;
    border-bottom: 16px solid transparent;
    top: -16px;
    right: -98px;
}
.face {
    position: absolute;
    height: 12px;
    width: 20px;
    background: white;
    border-radius: 20px 20px 0 0;
    transform: rotate(-40deg);
    right: -125px;
    top: -15px;
}
.face:after {
    content: "";
    height: 12px;
    width: 12px;
    background: white;
    right: 4px;
    top: 7px;
    position: absolute;
    transform: rotate(40deg);
    transform-origin: 50% 50%;
    border-radius: 0 0 0 2px;
}
h1 {
    margin-left: 100px;
    font-style: italic;
}

.col-12.col-md-6.col-xxl-3>div {
        justify-content: end;
    }

@media (max-width: 991.99px){
    .body {
        left: 50%;
        margin-left: -83px;
        margin-top: 1.5rem;
    }

    h1 {
        margin-left: 50%;
    }

    .col-12.col-md-6.col-xxl-3>div {
        justify-content: center;
    }
}

</style>