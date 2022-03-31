<template>
    <div class="container">
        <div class="row g-4">
            <div class="col">
                <div class="card d-flex flex-row">
                    <img v-if="user.image != null" :src="'/storage/'+user.image" class="card-img-top w-25" :alt="user.name">
                    <img v-else src="/storage/uploads/default/default_user.jpg" class="card-img-top w-25" :alt="user.name">
                    <div class="card-body">
                        <h5 class="card-title">{{ user.name }}</h5>
                        <!-- <p class="card-text">{{ user.category.name }}</p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col col-md-8">
                <div class="postcard light red" v-for="(dish, index) in dishes" :key="index">
                    <a class="postcard__img_link" href="#">
                        <img v-if="dish.image != null" :src="'/storage/'+dish.image" class="postcard__img" :alt="dish.name">
                        <img v-else src="/storage/uploads/default/default_dish.jpg" class="postcard__img" :alt="dish.name">
                    </a>
                    <div class="postcard__text t-dark">
                        <div class="d-flex align-items-center">
                            <h1 class="postcard__title red"><a href="#">{{ dish.name }}</a></h1>
                            <div class="postcard__tagbox ms-2">
                                <div v-if="dish.vegan" class="tag__item"><i class="fa-solid fa-leaf mr-2"></i></div>
                                <div v-if="dish.spicy" class="tag__item"><i class="fa-solid fa-pepper-hot mr-2"></i></div>
                            </div>
                        </div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt">{{ dish.description }}</div>
                        <div class="postcard__preview-txt">{{ dish.price.toFixed(2) }} &euro;</div>
                    </div>
                </div>
            </div>
        </div>
        <router-link class="btn btn-info mt-2" :to="{ name: 'home' }">Torna alla home</router-link>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    name: "Home",
    props: ['id'],
    data(){
        return {
            user: [],
            dishes: [],
        }
    },
    created(){
        const url = "http://127.0.0.1:8000/api/v1/";
        this.getUser(url);
        this.getDishes(url);
    },
    methods: {
        getUser(url){
            Axios.get(url + this.id,
            {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}
            ).then(
                (result) => {
                    console.log(result);
                    this.user = result.data.results.data;
                }
            );
        },
        getDishes(url){
            Axios.get(url + this.id + "/dishes",
            {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}
            ).then(
                (result) => {
                    console.log(result);
                    this.dishes = result.data.results.data;
                }
            );
        }
    }

}
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");
$main-red: #bd150b !default;
$main-red-rgb-015: rgba(189, 21, 11, 0.1) !default;
/* This pen */
body {
	font-family: "Baloo 2", cursive;
	font-size: 16px;
	color: #ffffff;
	text-rendering: optimizeLegibility;
	font-weight: initial;
}

.light {
	background: #f3f5f7;
}

a, a:hover {
	text-decoration: none;
	transition: color 0.3s ease-in-out;
}

#pageHeaderTitle {
	margin: 2rem 0;
	text-transform: uppercase;
	text-align: center;
	font-size: 2.5rem;
}

/* Cards */
.postcard {
    flex-wrap: wrap;
    display: flex;
    box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
    border-radius: 10px;
    margin: 0 0 2rem 0;
    overflow: hidden;
    position: relative;
    color: #ffffff;
	&.light {
		background-color: #e1e5ea;
	}
	
	.t-dark {
		color: #18151f;
	}
	
    a {
        color: inherit;
    }
    .postcard__title {
        font-size: 1.75rem;
    }

    .postcard__img {
        max-height: 180px;
        width: 100%;
        object-fit: cover;
        position: relative;
    }

    .postcard__img_link {
        display: contents;
    }

    .postcard__bar {
        width: 50px;
        height: 10px;
        margin: 10px 0;
        border-radius: 5px;
        background-color: #424242;
        transition: width 0.2s ease;
    }

    .postcard__text {
        padding: 1.5rem;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .postcard__preview-txt {
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: justify;
        height: 100%;
    }

    .postcard__tagbox {
        display: flex;
        flex-flow: row wrap;
        font-size: 14px;
            padding: 0;
        justify-content: center;

        .tag__item {
        display: inline-block;
        border-radius: 3px;
        font-size: 1.5em;
        padding: 2.5px 5px;
        margin: 0 5px 5px 0;
        cursor: default;
        user-select: none;
        transition: background-color 0.3s;
        }
    }

    &:before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: linear-gradient(-70deg, #424242, transparent 50%);
        opacity: 1;
        border-radius: 10px;
    }

    &:hover .postcard__bar {
        width: 100px;
    }
    }

@media screen and (min-width: 769px) {
  .postcard {
    flex-wrap: inherit;

    .postcard__title {
      font-size: 2rem;
    }

    .postcard__tagbox {
      justify-content: start;
    }

    .postcard__img {
      max-width: 300px;
      max-height: 100%;
      transition: transform 0.3s ease;
    }

    .postcard__text {
      padding: 1.5rem 3rem;
      width: 100%;
    }

    .media.postcard__text:before {
      content: "";
      position: absolute;
      display: block;
      background: #18151f;
      top: -20%;
      height: 130%;
      width: 55px;
    }

    // &>* {
    //     flex-direction: row-reverse;
    //     right: -12px !important;
    //     transform: rotate(-4deg);
    // }

    &:nth-child(2n+1) {
      flex-direction: row-reverse;
    }

    &:nth-child(2n+0) {
      flex-direction: row-reverse;
    }

    &:nth-child(2n+1) .postcard__text::before {
      right: -12px !important;
      transform: rotate(-4deg);
    }

    &:nth-child(2n+0) .postcard__text::before {
      right: -12px !important;
      transform: rotate(-4deg);
    }
  }
}
@media screen and (min-width: 1024px){
		.postcard__text {
      padding: 2rem 3.5rem;
    }
		
		.postcard__text:before {
      content: "";
      position: absolute;
      display: block;
      
      top: -20%;
      height: 130%;
      width: 55px;
    }
	
  .postcard.dark {
		.postcard__text:before {
			background: #18151f;
		}
  }
	.postcard.light {
		.postcard__text:before {
			background: #e1e5ea;
		}
  }
}

/* COLORS */

.postcard .postcard__tagbox .red.play:hover {
	background: $main-red;
}
.red .postcard__title:hover {
	color: $main-red;
}
.red .postcard__bar {
	background-color: $main-red;
}
.red::before {
	background-image: linear-gradient(30deg, $main-red-rgb-015, transparent 50%);
}
// .red:nth-child(2n)::before {
// 	background-image: linear-gradient(30deg, $main-red-rgb-015, transparent 50%);
// }

@media screen and (min-width: 769px) {

	.red::before {
		background-image: linear-gradient(80deg, $main-red-rgb-015, transparent 50%);
	}
	// .red:nth-child(2n)::before {
	// 	background-image: linear-gradient(80deg, $main-red-rgb-015, transparent 50%);
	// }
	
}

</style>