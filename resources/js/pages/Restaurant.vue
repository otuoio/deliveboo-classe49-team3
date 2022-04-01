<template>
<div>
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
                <div v-for="(dish, index) in dishes" :key="index">
                    <AddDish
                                :dish="dish"
                                @setPrice="setPrice($event)"
                                @setQuantity="setQuantity($event)"
                                @setName="setName($event)"
                                @addDishestoArray="addDishestoArray"/>
                    <div class="postcard light red" role="button" data-bs-toggle="modal" :data-bs-target="`#exampleModal${dish.id}`">
                        <a class="postcard__img_link" href="#">
                            <img v-if="dish.image != null" :src="'/storage/'+dish.image" class="postcard__img" :alt="dish.name">
                            <img v-else src="/storage/uploads/default/default_dish.jpg" class="postcard__img" :alt="dish.name">
                        </a>
                        <div class="postcard__text t-dark">
                            <div class="d-flex align-items-center">
                                <h1 class="postcard__title red">{{ dish.name }}</h1>
                                
                                <div class="postcard__tagbox ms-2">
                                    <div v-if="dish.vegan" class="tag__item"><i class="fa-solid fa-leaf mr-2"></i></div>
                                    <div v-if="dish.spicy" class="tag__item"><i class="fa-solid fa-pepper-hot mr-2"></i></div>
                                </div>
                            </div>
                            <div class="postcard__bar"></div>
                            <div class="postcard__preview-txt">{{ shortDescription(dish.description) }}</div>
                            <div class="postcard__preview-txt">{{ dish.price.toFixed(2) }} &euro;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="postcard light red">
                    <!-- <a class="postcard__img_link" href="#">
                        <img v-if="dish.image != null" :src="'/storage/'+dish.image" class="postcard__img" :alt="dish.name">
                        <img v-else src="/storage/uploads/default/default_dish.jpg" class="postcard__img" :alt="dish.name">
                    </a> -->
                    <div class="postcard__text t-dark">
                        <div class="d-flex align-items-center">
                            <h1 class="postcard__title red"><a href="#">Carrello</a></h1>
                        </div>
                        <div class="postcard__bar"></div>
                        <div v-if="cartDishes.length == 0" class="postcard__preview-txt">Il carrello &egrave; vuoto</div>
                        <div v-else class="postcard__preview-txt">
                            <div v-for="(cartDish, index) in cartDishes" :key="'cartDish' + index">
                                <span>{{ cartDish.name }}</span>
                                <span>{{ cartDish.quantity }}</span>
                                <span>{{ cartDish.price.toFixed(2) }}</span>
                            </div>
                        </div>
                        <div class="postcard__preview-txt">{{cartTotal.toFixed(2)}} &euro;</div>
                    </div>
                </div>
            </div>
        </div>
        <router-link class="btn btn-info mt-2" :to="{ name: 'home' }">Torna alla home</router-link>
    </div>
</div>
</template>

<script>
import Axios from "axios";
import AddDish from '../components/AddDish';

export default {
    name: "Home",
    props: ['id'],
    components: {
        AddDish
    },
    data(){
        return {
            user: [],
            dishes: [],
            cartTotal: 0,
            quantity: 0,
            cartDishes: [
            ],
            name: '',
            price: 0,
        }
    },
    created(){
        const url = "http://127.0.0.1:8000/api/v1/";
        this.getUser(url);
        this.getDishes(url);
    },
    methods: {
        setQuantity(value) {
            this.quantity = value;
            console.log(value);
        },
        setName(value) {
            this.name = value;
            console.log(value);
        },
        setPrice(value) {
            this.price = value;
            console.log(value.toFixed(2));
        },
        addDishestoArray(){
            let obj = {};
            obj['name'] = this.name;
            obj['price'] = this.price;
            obj['quantity'] = this.quantity;
            this.cartDishes.push(obj);
            console.log(this.cartDishes);
            this.cartTotal += this.price;
        },
        shortDescription(string) {
            if (string.length > 60) {
                return string.substring(0, 60) + '...';
            } else {
                return string;
            }
        },
        getUser(url){
            Axios.get(url + this.id,
            {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}
            ).then(
                (result) => {
                    this.user = result.data.results.data;
                }
            );
        },
        getDishes(url){
            Axios.get(url + this.id + "/dishes",
            {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}
            ).then(
                (result) => {
                    this.dishes = result.data.results.data;
                }
            );
        },
        addItem() {
                // aggiunge una quantità
                if (this.qty < 9) {
                    this.qty++;
                    // annimazione mangia coin
                    // const timeline = gsap.timeline({defaults: {duration: 1}});
    
                    // timeline
                    // .to('.addItem', {x: '500%', ease: 'power2'})
                    // .to('.face_up', {rotate: '45' }, '-=1')
                    // .to('.face_down', {rotate: '-45' }, '-=1')
                    // .to('.face_up', {rotate: '0', ease: 'power2'}, '-=0.4')
                    // .to('.face_down', {rotate: '0', ease: 'power2'}, '-=1')
                    // .eventCallback("onComplete", function() {
                    // timeline.pause(0);});
    
                    // const smileFace = gsap.timeline({defaults: {duration: 1, delay: 2.3}});
    
                    // smileFace
                    // .to('.eye', {opacity: 1, ease: 'power3'}, '-=1')
                    // // .to('.smile', {opacity: 1, ease: 'power3'}, '-=3.3')
                    // .eventCallback("onComplete", function() {
                    // smileFace.pause(0);});
                } else {
                    this.enough = true;
                    setTimeout(() => {
                        this.enough = false;
                    }, 1000);
                }


            },
            removeItem() {
                if (this.qty > 0) {
                    this.qty--;

                    // const sadFace = gsap.timeline({defaults: {duration: 0.1}});
    
                    // sadFace
                    // .to('.face', {x: '5%', ease: 'bounce'})
                    // .to('.face', {x: '-5%', ease: 'bounce'})
                    // .to('.face', {x: '5%', ease: 'bounce'})
                    // .to('.face', {x: '-5%', ease: 'bounce'})
                    // .to('.face', {x: '5%', ease: 'bounce'})
                    // .to('.face', {x: '-5%', ease: 'bounce'})
                    // .to('.face', {x: '5%', ease: 'bounce'})
                    // .to('.face', {x: '-5%', ease: 'bounce'})
                    // .to('.face', {x: '5%', ease: 'bounce'})
                    // .to('.eye_down', 1, {opacity: 1}, '-=1')
                    // // .to('.smile_down', {opacity: 1, ease: 'inOut'}, '-=1')
                    // .eventCallback("onComplete", function() {
                    // sadFace.pause(0);});
                } else {
                    this.oneMore = true;
                    setTimeout(() => {
                        this.oneMore = false;
                    }, 1000);
                }
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