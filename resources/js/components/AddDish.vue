<template>
<div class="modal fade" :id="`exampleModal${dish.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class=" d-flex justify-content-center h-100 w-100"> -->
                <figure class="card-product-grid card-lg overflow-hidden m-0">
                    <img v-if="dish.image != null" :src="'/storage/'+dish.image" class="img-fluid" :alt="dish.name">
                    <img v-else src="/storage/uploads/default/default_dish.jpg" class="img-fluid" :alt="dish.name">
                    <figcaption class="info-wrap">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-center">{{ dish.name }}</h2>
                            </div>
                        </div>
                    </figcaption>
                    <div class="bottom-wrap-payment">
                        <figcaption class="info-wrap">
                            <div class="row">
                                <div class="col">
                                    <p class="text-center">{{ dish.description }}</p>
                                </div>
                            </div>
                        </figcaption>
                    </div>
                    <div class="bottom-wrap">
                        <div class="row justify-content-center align-items-center">
                            <div class="col col-md-2 d-flex justify-content-center">
                                <div class="btn btn-primary rounded-circle d-flex justify-content-center align-items-center" style="height: 40px; width: 40px;" @click="removeItem(dish.price.toFixed(2))"><span>&minus;</span></div>
                            </div>
                            <div class="col col-md-1 p-0 d-flex justify-content-center">
                                <div class="text-center">{{ qty }}</div>
                            </div>
                            <div class="col col-md-2 d-flex justify-content-center">
                                <div class="btn btn-primary rounded-circle d-flex justify-content-center align-items-center" style="height: 40px; width: 40px;" @click="addItem(dish.price.toFixed(2))"><span>&plus;</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <h3>{{cartP(dish.price.toFixed(2), qty)}} &euro;</h3>
                                <button class="btn btn-primary" @click="toCart(dish.price.toFixed(2), qty, dish.name, dish.user_id, dish.id)" data-bs-dismiss="modal">Aggiungi al carrello</button>
                            </div>
                        </div>
                    </div>
                </figure>
            <!-- </div> -->
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'AddDish',
    props: ['dish'],
    data() {
        return {
            qty: 1,
            cartPrice: 0,
            oneMore: false,
            enough: false,
        }
    },
    methods: {
        toCart(price, quantity, name, userID, dish_id) {
            this.$emit('setQuantity', quantity);
            this.$emit('setName', name);
            setTimeout(() => {
                this.qty = 1;
            }, 500);
            price = price * quantity;
            this.$emit('setPrice', price);
            this.$emit('setDishID', dish_id);
            this.$emit('setUserID', userID);
            // this.$emit('addDishestoArray');
            this.$emit('setItem');
        },
        cartP(price, quantity) {
            return this.cartPrice = (price * quantity).toFixed(2);
            
        },
        addItem(price) {
                // aggiunge una quantità
                if (this.qty < 9) {
                    this.qty++;
                    this.cartPrice = (price * this.qty);
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
            removeItem(price) {
                if (this.qty > 1) {
                    this.qty--;
                    this.cartPrice = (price * this.qty);
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
            },

            // doShowAll() {
            //     let key = "";
            //     let i = 0;
            //     //for more advance feature, you can set cap on max items in the cart
            //     for (i = 0; i <= localStorage.length-1; i++) {
            //         key = localStorage.key(i);
            //         // console.log(key);
            //         this.list.push(JSON.parse(localStorage.getItem(key)));
            //     }
            // }

    }
}
</script>

<style lang="scss" scoped>
body {
    background-color: #EEEEEE
}

a {
    text-decoration: none !important
}

.card-product-list,
.card-product-grid {
    margin-bottom: 0
}

.card {
    width: 500px;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 23px;
    margin-top: 50px
}

.card-product-grid:hover {
    -webkit-box-shadow: 0 4px 15px rgba(153, 153, 153, 0.3);
    box-shadow: 0 4px 15px rgba(153, 153, 153, 0.3);
    -webkit-transition: .3s;
    transition: .3s
}

.card-product-grid .img-wrap {
    border-radius: 0.2rem 0.2rem 0 0;
    height: 220px
}

.card .img-wrap {
    overflow: hidden
}

.card-lg .img-wrap {
    height: 280px
}

.card-product-grid .img-wrap {
    border-radius: 0.2rem 0.2rem 0 0;
    height: 275px;
    padding: 16px
}

[class*='card-product'] .img-wrap img {
    height: 100%;
    max-width: 100%;
    width: auto;
    display: inline-block;
    -o-object-fit: cover;
    object-fit: cover
}

.img-wrap {
    text-align: center;
    display: block
}

.card-product-grid .info-wrap {
    overflow: hidden;
    padding: 18px 20px
}

[class*='card-product'] a.title {
    color: #212529;
    display: block
}

.rating-stars {
    display: inline-block;
    vertical-align: middle;
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
    white-space: nowrap;
    clear: both
}

.rating-stars li.stars-active {
    z-index: 2;
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden
}

.rating-stars li {
    display: block;
    text-overflow: clip;
    white-space: nowrap;
    z-index: 1
}

.card-product-grid .bottom-wrap {
    padding: 18px;
    border-top: 1px solid #e4e4e4
}

.bottom-wrap-payment {
    padding: 0px;
    border-top: 1px solid #e4e4e4
}

.rated {
    font-size: 10px;
    color: #b3b4b6
}

.btn {
    display: inline-block;
    font-weight: 600;
    color: #343a40;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.45rem 0.85rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.2rem
}

.btn-primary {
    color: #fff;
    background-color: #3167eb;
    border-color: #3167eb
}

.fa {
    color: #FF5722
}

.modal-content {
    border-radius: 0px;
}
</style>