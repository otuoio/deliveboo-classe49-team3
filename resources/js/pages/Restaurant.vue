<template>
    <div class="app-main">
        <div class="app-main__outer p-0">
            <div class="row g-4">
                <div class="col p-0 m-0">
                    <div class="rounded-0 card d-flex flex-row">
                        <img v-if="user.image != null" :src="'/storage/'+user.image" class="card-img-top w-25" :alt="user.name">
                        <img v-else src="/storage/uploads/default/default_user.jpg" class="card-img-top w-25" :alt="user.name">
                        <div class="card-body restaurant-info d-flex flex-column justify-content-center">
                            <h2 class="card-title">{{ user.name }}</h2>
                            <div class="mt-4">
                                <div>
                                    <span>15-30 min</span> · 
                                    <span v-if="user.shipment_price == 0">Consegna gratuita</span>
                                    <span v-else>Costo di consegna: &euro; {{ user.shipment_price.toFixed(2)}}</span>
                                </div>
                                <div class="mt-2">
                                    <span>{{ user.address}}</span> · 
                                    <span>Distanza: 1.5 km</span>
                                </div>
                                <div class="mt-2">
                                    <span><i class="fa-solid fa-phone"></i> {{ user.phone_number}}</span> · 
                                    <span><a :href="`tel:${user.phone_number}`">Chiama il ristorante</a></span>
                                </div>
                            </div>
                            <!-- <p class="card-text">{{ user.category.name }}</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-main__inner">
                <div class="row g-4">
                    <div class="col col-md-8">
                        <div v-for="(dish, index) in dishes" :key="index">
                            <AddDish
                                        :dish="dish"
                                        @setPrice="setPrice($event)"
                                        @setQuantity="setQuantity($event)"
                                        @setName="setName($event)"
                                        @setUserID="setUserID($event)"
                                        @setItem="setItem"
                                        @setDishID="setDishID"/>
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
                        <div class="card m-0 ms-4">
                            <div class="row">
                                <div class="col-md-12 cart">
                                    <div class="title">
                                        <div class="row">
                                            <div class="col d-flex justify-content-between align-items-center">
                                                <h4 class="cart-title"><b>Carrello</b></h4>
                                                <span @click="emptyCart" role="button"><i class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="cartTotal == user.shipment_price || cartTotal == 0">
                                        <div class="row border-top border-bottom">
                                            <div class="row main align-items-center">
                                                Il carrello &egrave; vuoto
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="row border-top border-bottom" v-for="(cartDish, index) in cartDishes" :key="'cartDish' + index">
                                            <div class="row main align-items-center">
                                                <div class="col">
                                                    <div class="row">{{ cartDish.name }}</div>
                                                </div>
                                                <div class="col text-center">
                                                    <span @click="removeItem(cartDish)" role="button">-</span>
                                                    <span class="d-inline-block border">{{ cartDish.quantity }}</span>
                                                    <span @click="addItem(cartDish)" role="button">+</span>
                                                </div>
                                                <div class="col text-end">&euro; {{ cartDish.price.toFixed(2) }}<span class="close ms-3 align-middle" @click="removeDish(cartDish)"><i class="fa-solid fa-xmark"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                            <div class="col">Costo di consegna</div>
                                            <div class="col text-end">&euro; {{ user.shipment_price.toFixed(2) }}<span class="invisible close ms-3 align-middle" @click="removeDish(cartDish)"><i class="fa-solid fa-xmark"></i></span></div>
                                        </div>
                                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                            <div class="col">TOTALE</div>
                                            <div class="col text-end">&euro; {{cartTotal.toFixed(2)}}<span class="invisible close ms-3 align-middle" @click="removeDish(cartDish)"><i class="fa-solid fa-xmark"></i></span></div>
                                        </div>
                                        <router-link class="btn btn-myblue" :to="{ name: 'checkout'}"> 
                                            CHECKOUT
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            cartDishes: [],
            name: '',
            price: 0,
            userID: '',
            dishPrice: 0,
            storage: '',
            showC: false,
            dish_id:''
        }
    },
    created(){
        const url = "http://127.0.0.1:8000/api/v1/";
        this.getUser(url);
        this.getDishes(url);
        // setTimeout(() => {
            
        // }, 500);

    },
    methods: {
        setQuantity(value) {
            this.quantity = value;
        },
        setDishID(value) {
            this.dish_id = value;
        },
        setName(value) {
            this.name = value;
        },
        setPrice(value) {
            this.price = value;
        },
        setUserID(value){
            this.userID = value;
        },
        // addDishestoArray(){
        //     let obj = {
        //         name: this.name,
        //         price: this.price,
        //         quantity: this.quantity,
        //         userID: this.userID,
        //     };
        //     if(this.cartDishes.length == 0){
        //         this.cartTotal = this.price + this.user.shipment_price;
        //         this.cartDishes.push(obj);
        //     }else{
        //         this.cartTotal += this.price;
        //         this.cartDishes.forEach((dish, index) => {
        //             if(dish.name == obj.name){
        //                 obj['price'] = dish.price + this.price;
        //                 obj['quantity'] = dish.quantity + this.quantity;
        //                 this.cartDishes.splice(index, 1);
        //             }
        //         });
        //         this.cartDishes.push(obj);
        //     };
        //     this.dishPrice = (obj['price'] / obj['quantity']);
        //     localStorage.setItem('cartDishes', JSON.stringify(this.cartDishes));
        //     console.log(this.dishPrice);
        // },
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
                    if (localStorage.length > 0) {
                        let key = localStorage.key(0);
                        this.userID = JSON.parse(localStorage.getItem(key)).userID;
                        if(this.userID != (this.user.id)){
                            alert('Il carrello è stato svuotato');
                            localStorage.clear();
                        }
                    };

                    this.showCart();
                    this.cartTotal = this.user.shipment_price;
                    for (let i = 0; i < localStorage.length; i++) {
                        let key = localStorage.key(i);
                        let cartPrice = JSON.parse(localStorage.getItem(key)).price;
                        this.cartTotal += cartPrice;
                    };
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
        showCart() {
            // variabile per mostrare il carrello (da modificare)
            this.showC = true;
            // dichiaro un array temporaneo in cui pushare ciclicamente gli array salvati nello storage
            let array = [];

            // ciclo su storage per pushare i singoli obj nell'array temporaneo
            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                let obj = JSON.parse(localStorage.getItem(key));
                array.push(obj);
            };
            console.log(localStorage);
            // assegno l'array temporaneo al cartDishes array che stampa i piatti nel carrello
            this.cartDishes = array;
            console.log(this.cartTotal);
        },
        setItem() {
            // creo key e value per il local storage
            let name = this.name;
            let dish = {
                name: this.name,
                id: this.dish_id,
                price: this.price,
                quantity: this.quantity,
                userID: this.userID
            }
            // controllo se il piatto ancora non è nello storage
            if (localStorage.getItem(name) != null) {
                // se c'è aggiorno il value per la key esistente
                dish = {
                    name: this.name,
                    id: this.dish_id,
                    price: JSON.parse(localStorage.getItem(name)).price + this.price,
                    quantity: JSON.parse(localStorage.getItem(name)).quantity + this.quantity,
                    userID: this.userID
                };
                localStorage.setItem(name, JSON.stringify(dish));

            } else {
                // se non c'è salvo key e value in un nuovo item del local storage
                localStorage.setItem(name, JSON.stringify(dish));
            }
            this.cartTotal = this.user.shipment_price;
            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                let cartPrice = JSON.parse(localStorage.getItem(key)).price;
                this.cartTotal += cartPrice;
            };
            this.showCart();
            
        },
        addItem(obj) {
            this.dishPrice = obj.price / obj.quantity;
            // aggiorno l'oggetto da salvare nello storage
            let name = obj.name;
            let dish = {
                name: obj.name,
                id: obj.id,
                price: JSON.parse(localStorage.getItem(name)).price + this.dishPrice,
                quantity: JSON.parse(localStorage.getItem(name)).quantity + 1,
                userID: obj.userID
            }

            // salvo il nuovo oggetto nello storage
            localStorage.setItem(name, JSON.stringify(dish));

            
            this.cartTotal = this.user.shipment_price;
            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                let cartPrice = JSON.parse(localStorage.getItem(key)).price;
                this.cartTotal += cartPrice;
            };
            this.showCart();
        },
        removeItem(obj) {
            let name = obj.name;
            this.dishPrice = obj.price / obj.quantity;
            if (obj.quantity > 1) {

                // aggiorno l'oggetto da salvare nello storage
                let dish = {
                    name: obj.name,
                    id: obj.id,
                    price: JSON.parse(localStorage.getItem(name)).price - this.dishPrice,
                    quantity: JSON.parse(localStorage.getItem(name)).quantity - 1,
                    userID: obj.userID
                }

                // salvo il nuovo oggetto nello storage
                localStorage.setItem(name, JSON.stringify(dish));
            } else {
                localStorage.removeItem(name);
            }
            this.cartTotal -= this.dishPrice;
            this.showCart();
        },
        removeDish(obj){
            let name = obj.name;
            localStorage.removeItem(name);
            this.cartTotal -= obj.price;
            this.showCart();

        },
        emptyCart(){
            localStorage.clear();
            this.cartTotal = this.user.shipment_price;
            this.showCart();

        },
    }

}
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");
$main-red: #bd150b !default;
$main-red-rgb-015: rgba(189, 21, 11, 0.1) !default;
/* This pen */
// body {
// 	font-family: "Baloo 2", cursive;
// 	font-size: 16px;
// 	color: #ffffff;
// 	text-rendering: optimizeLegibility;
// 	font-weight: initial;
// }

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

// .full-width {
//     width: 100% !important;
//     max-width: 100%;
// }
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

// CARRELLO
body {
    background: #ddd;
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold
}

.title {
    margin-bottom: 5vh
}

.card {
    margin: auto;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent
}

@media(max-width:767px) {
    .card {
        margin: 3vh auto
    }
}

.cart {
    background-color: #fff;
    padding: 4vh 5vh;
}

@media(max-width:767px) {
    .cart {
        padding: 4vh;
    }
}

.summary {
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65)
}

@media(max-width:767px) {
    .summary {
        border-top-right-radius: unset;
        border-bottom-left-radius: 1rem
    }
}

.summary .col-2 {
    padding: 0
}

.summary .col-10 {
    padding: 0
}

.row {
    margin: 0
}

.title b {
    font-size: 1.5rem
}

.main {
    margin: 0;
    padding: 2vh 0;
    width: 100%
}

.col-2,
.col {
    padding: 0 1vh
}

a {
    padding: 0 1vh
}

.close {
    margin-left: auto;
    font-size: 0.7rem
}

img {
    width: 3.5rem
}

.back-to-shop {
    margin-top: 4.5rem
}

h5 {
    margin-top: 4vh
}

hr {
    margin-top: 1.25rem
}

form {
    padding: 2vh 0
}

select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input:focus::-webkit-input-placeholder {
    color: transparent
}

.btn {
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.btn:hover {
    color: white
}

a {
    color: black
}

a:hover {
    color: black;
    text-decoration: none
}

#code {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}

.fa-xmark {
    color: rgb(163, 0, 0);
    cursor: pointer;
    font-size: 1.5em;
}
.fa-trash {
    font-size: 1.5em;
}



.cart-title {
    line-height: 0.8em;
    margin: 0;
}

.restaurant-info {
    .card-title {
        font-weight: bold;
    }
    .fa-phone {
        color: #01678F;
    }

    a {
        color: #01678F;
    }

    span {
        font-size: 1rem;
    }

}
</style>