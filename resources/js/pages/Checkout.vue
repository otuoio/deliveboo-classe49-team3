<template>
  <div class="container">
    <div class="row">
      <div class="col col-md-8">
        <div v-if="paymentForm" class="main-card mb-3 card">
          <div class="card-body">
            <form>
              <div class="position-relative row form-group">
                <label for="customer_name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                  <input id="customer_name" name="customer_name" placeholder="Inserisci il nome completo" required type="text" class="form-control" v-model="form.customer_name">
                </div>
              </div>
              <div class="position-relative row form-group">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input id="email" name="email" placeholder="Inserisci la tua mail" required type="email" class="form-control" v-model="form.email">
                </div>
              </div>
              <div class="position-relative row form-group">
                <label for="phone_number" class="col-sm-2 col-form-label">Numero di telefono</label>
                <div class="col-sm-10">
                  <input id="phone_number" type="text" minlength="8" class="form-control" name="phone_number" value="" required autocomplete="phone_number" autofocus v-model="form.phone_number">
                </div>
              </div>
              <div class="position-relative row form-group">
                <label for="address" class="col-sm-2 col-form-label">Indirizzo di consegna</label>
                <div class="col-sm-10">
                  <input id="address" type="text" class="form-control" name="address" value="" required autocomplete="address" autofocus v-model="form.address">
                </div>
              </div>
            </form>
            <v-braintree 
              authorization="sandbox_x6p9dcjd_7nfbkpdgq66q9h4g"
              @success="onSuccess"
              @error="onError"
            >
            </v-braintree>
          </div>
        </div>
        <div v-else class="main-card mb-3 card">
          <div class="card-body">
            <div class="confirmation">
              <img class="img-fluid" src="../../img/orderConfirmed.gif" alt="">
              <h4 class="header-title mb-3">Il tuo ordine arriver&agrave; per le {{ getDate() }}</h4>
            </div>
            <div class="mt-5">
              <h3>Ottime notizie! {{ user.name }} ha confermato il tuo ordine.</h3>
              <p>Ti &egrave; appena arrivata una mail all'indirizzo {{ form.email }}.</p>
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
                                  <h4 class="cart-title" v-if="paymentForm"><strong>Carrello</strong></h4>
                                  <h4 class="cart-title" v-else><strong>Riepilogo dell'ordine</strong></h4>
                              </div>
                          </div>
                      </div>
                      <div>
                          <div class="row border-top border-bottom" v-for="(cartDish, index) in form.cartDishes" :key="'cartDish' + index">
                              <div class="row main align-items-center">
                                  <div class="col">
                                      <div class="row">{{ cartDish.name }}</div>
                                  </div>
                                  <div class="col">
                                      <span class="d-inline-block border">{{ cartDish.quantity }}</span> 
                                  </div>
                                  <div class="col">&euro; {{ cartDish.price.toFixed(2) }}
                                  </div>
                              </div>
                          </div>
                          <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                              <div class="col">Costo di consegna</div>
                              <div v-if="user.shipment_price" class="col offset-4 text-right">&euro; {{user.shipment_price.toFixed(2) }}</div>
                          </div>
                          <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                              <div class="col"> <b>TOTALE</b> </div>
                              <div class="col offset-4 text-right">&euro; {{form.cartTotal.toFixed(2)}}</div>
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
import Axios from 'axios';

export default {
  name: 'Checkout',
  data() {
    return {
      user: [],
      userID: 0,
      paymentForm: true,
      form: {
        customer_name:'',
        email:'',
        phone_number:'',
        address:'',
        cartDishes: [],
        cartTotal:0
      },
    }
  },
  created () {
    this.getArray();
    this.getUser();
    console.log(localStorage);
  },
  methods: {
    getArray() {
      let array = [];
      for (let index = 0; index < localStorage.length; index++) {
        let key = localStorage.key(index);
        let obj = JSON.parse(localStorage.getItem(key));
        array.push(obj);
        this.form.cartTotal += obj.price;
        this.userID = obj.userID;
      }
      this.form.cartDishes = array;
    },
    getUser(){
      Axios.get("http://127.0.0.1:8000/api/v1/" + this.userID,
      {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}
      ).then(
        (result) => {
          this.user = result.data.results.data;
          console.log(this.user);
          this.form.cartTotal += this.user.shipment_price;
        }
      );
    },
    onSuccess (payload) {
      let nonce = payload.nonce;
      this.sendOrder();
      // this.sendMail();
      this.paymentForm = false;
      localStorage.clear();
    },
    onError (error) {
      let message = error.message;
      console.log('errore', message);
    },
    sendOrder() {
      const headers = { 
        'Content-Type': 'application/json', 
        'Authorization': 'Bearer dkfsajksdfj432dskj',
      };
      const url = "http://127.0.0.1:8000/api/v1/orders/checkout";

      Axios.post(url, {params: {
        info: this.form 
      }})
        .then((result) => {
          console.log(result.data, result.status );
        })
      .catch(error => console.log(error));
    },
    getDate(){
      let oldDateObj = new Date();
      let diff = 30;
      let newDateObj = new Date(oldDateObj.getTime() + diff*60000);
      return newDateObj.getHours() + ":" + (newDateObj.getMinutes()<10?'0':'') + newDateObj.getMinutes();
      
    },
    // sendMail(){
    //   const url = "http://127.0.0.1:8000/api/v1/mail";

    //   Axios.post(url, {params: {
    //     info: this.form 
    //   }})
    //     .then((result) => {
    //       console.log(result);
    //     })
    //   .catch(error => console.log(error));
    // }
  }
}
</script>

<style lang="scss" scoped>
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
    max-width: 950px;
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

// img {
//     width: 3.5rem
// }

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
    background-color: #000;
    border-color: #000;
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

.confirmation {
  width: 50%;
  margin: auto;
  text-align: center;
  border: 2px solid black;
  border-radius: 10px;
  overflow: hidden;
}
</style>