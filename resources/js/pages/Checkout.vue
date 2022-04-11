<template>
<div class="app-main">
  <div class="app-main__outer p-0 pt-5 pb-5">
    <div class="container">
      <div class="row">
      <div class="col-md-12 col-lg-7 col-xl-8">
        <div v-if="loading">
          <div class="main-card mb-3 card">
            <div class="card-body text-center">
              <div class="confirmation p-4">
                <i class="fs5 fas fa-circle-notch fa-spin py-4"></i>
                <h4 class="header-title mb-3">Pagamento in corso</h4>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          <div v-if="paymentForm">
            <div v-if="showPayment == false" class="main-card mb-3 card">
              <div class="card-body p-4">
                <form @submit.prevent="sendToPay()" id="myform">
                  <div class="position-relative row form-group">
                    <label for="customer_name" class="col-12 col-md-3 col-form-label p-0 pb-2 pb-md-0">Nome e cognome*</label>
                    <div class="col-12 col-md-9 px-0 px-md-3">
                      <input id="customer_name" required name="customer_name" type="text" class="form-control" autofocus v-model="customer_name">
                    </div>
                    <div>
                      <p class="alert alert-danger" v-for="(error, index) in errors.customer_name" :key="index">
                          {{ error }}
                      </p>
                    </div>
                  </div>
                  <div class="position-relative row form-group">
                    <label for="email" class="col-12 col-md-3 col-form-label p-0 pb-2 pb-md-0">Indirizzo e-mail*</label>
                    <div class="col-12 col-md-9 px-0 px-md-3">
                      <input id="email" name="email" required type="email" class="form-control" v-model="email">
                    </div>
                    <div>
                      <p class="alert alert-danger" v-for="(error, index) in errors.email" :key="index">
                          {{ error }}
                      </p>
                    </div>
                  </div>
                  <div class="position-relative row form-group">
                    <label for="phone_number" class="col-12 col-md-3 col-form-label p-0 pb-2 pb-md-0">Numero di telefono*</label>
                    <div class="col-12 col-md-9 px-0 px-md-3">
                      <input id="phone_number" required type="text" pattern="[0-9]{8,12}" class="form-control" name="phone_number" value="" autocomplete="phone_number" v-model="phone_number">
                    </div>
                    <div>
                      <p class="alert alert-danger" v-for="(error, index) in errors.phone_number" :key="index">
                          {{ error }}
                      </p>
                    </div>
                  </div>
                  <div class="position-relative row form-group">
                    <label for="address" class="col-12 col-md-3 col-form-label p-0 pb-2 pb-md-0">Indirizzo di consegna*</label>
                    <div class="col-12 col-md-9 px-0 px-md-3">
                      <input id="address" type="text" required class="form-control" name="address" value="" autocomplete="address" autofocus v-model="address">
                    </div>
                    <div>
                      <p class="alert alert-danger" v-for="(error, index) in errors.address" :key="index">
                          {{ error }}
                      </p>
                    </div>
                  </div>
                  <button class="btn btn-primary mt-2" type="submit">
                    Vai al pagamento
                  </button>
                  <router-link class="btn btn-show mt-2 ms-0 ms-sm-3" :to="{ name: 'home' }">Torna ai ristoranti</router-link>
                </form>
              </div>
            </div>
            <div v-else class="main-card mb-3 card">
              <div class="card-body">
                <v-braintree 
                  authorization="sandbox_x6p9dcjd_7nfbkpdgq66q9h4g"
                  @success="onSuccess"
                  @error="onError"
                  :locale="locale"
                  btnText="Conferma ordine"
                >
                </v-braintree>
              </div>
            </div>
          </div>
          <div v-else class="main-card mb-3 card  text-center">
            <div class="card-body">
              <div class="confirmation">
                <img class="img-fluid" src="../../img/orderConfirmed.gif" alt="">
                <h4 class="header-title mb-3">Il tuo ordine arriver&agrave; per le {{ getDate() }}</h4>
              </div>
              <div class="mt-5">
                <h3>Ottime notizie! {{ user.name }} ha confermato il tuo ordine.</h3>
                <p>Ti &egrave; appena arrivata una mail all'indirizzo {{ form.email }}.</p>
              </div>
              <router-link class="btn btn-show py-2 px-3 mt-4" :to="{ name: 'home' }">Torna ai ristoranti</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-5 col-xl-4">
          <div class="card m-0 ms-0 ms-lg-4">
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
                          <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 0.5rem 0;" v-for="(cartDish, index) in form.cartDishes" :key="'cartDish' + index">
                              <div class="col">
                                  <span class="me-2">{{ cartDish.quantity }}x</span><span>{{ cartDish.name }}</span>
                              </div>
                              <!-- <div class="col text-center">
                                  <span class="d-inline-block border">{{ cartDish.quantity }}</span> 
                              </div> -->
                              <div class="col text-end">&euro; {{ cartDish.price.toFixed(2) }}
                              </div>
                          </div>
                          <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 0.5rem 0;">
                              <div class="col">Costo di consegna</div>
                              <div v-if="user.shipment_price" class="col text-end">&euro; {{user.shipment_price.toFixed(2) }}</div>
                          </div>
                          <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 0.5rem 0;">
                              <div class="col fw-bold">TOTALE</div>
                              <div class="col text-end fw-bold">&euro; {{form.cartTotal.toFixed(2)}}</div>
                          </div>
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
import Axios from 'axios';
import { time } from 'console';
import { timeout } from 'q';

export default {
  name: 'Checkout',
  data() {
    return {
      user: [],
      locale: 'it_IT',
      userID: 0,
      slug: '',
      paymentForm: true,
      loading: false,
      customer_name: '',
      email: '',
      phone_number: '',
      address: '',
      showPayment: false,
      errors: {},
      success: false,
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
        this.slug = obj.userSlug;

      }
      this.form.cartDishes = array;
    },
    getUser(){
      Axios.get("http://127.0.0.1:8000/api/v1/" + this.slug + '?slug=' + this.slug,
      {headers: {'Authorization': 'Bearer dkfsajksdfj432dskj'}}
      ).then(
        (result) => {
          this.user = result.data.results.data[0];
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
      this.loading = true;
      Axios.post(url, {params: {
        info: this.form 
      }})
        .then((result) => {
          console.log(result.data, result.status );
          this.loading = false;
        })
      .catch(error => console.log(error));
    },
    getDate(){
      let oldDateObj = new Date();
      let diff = 30;
      let newDateObj = new Date(oldDateObj.getTime() + diff*60000);
      return newDateObj.getHours() + ":" + (newDateObj.getMinutes()<10?'0':'') + newDateObj.getMinutes();
    },
    sendToPay(){
      this.success = false;
      const url = "http://127.0.0.1:8000/api/v1/orders/checkout/validation";
      Axios.post(url, {params: {
        info: {
          'customer_name' : this.customer_name,
          'phone_number' : this.phone_number,
          'email' : this.email,
          'address' : this.address,
        }
      }})
        .then((result) => {
          if(result.data.success == true){
            this.showPayment = true;
            this.success = true;
            this.errors = {};
            this.form.customer_name = this.customer_name;
            this.form.phone_number = this.phone_number;
            this.form.email = this.email;
            this.form.address = this.address;
          }else{
            this.success = false;
            this.errors = result.data.errors;
            // let customerNameError = document.getElementById('customer-name-error');
            // let emailError = document.getElementById('email-error');
            // let phoneNumberError = document.getElementById('phone-number-error');
            // let addressError = document.getElementById('address-error');

            console.log(result.data.errors);

          }
        })
      .catch(error => console.log(error));
    }
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
    margin-bottom: 1.5rem;
}

.card {
    margin: auto;
    max-width: 950px;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 0;
    border: transparent
}

.main-card {
  border-radius: 0;
}

@media(max-width:767px) {
    .card {
        margin: 3vh auto
    }
}

.cart {
    background-color: #fff;
    padding: 1.5rem 1.5rem;
}

@media(max-width:767px) {
    .cart {
        padding: 1rem;
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
    padding: 0 0;
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
    padding: 0.5rem 0
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

// .btn {
//     // background-color: #000;
//     // border-color: #000;
//     // color: white;
//     width: 100%;
//     font-size: 0.7rem;
//     margin-top: 4vh;
//     padding: 1vh;
//     border-radius: 0
// }

// .btn:focus {
//     box-shadow: none;
//     outline: none;
//     box-shadow: none;
//     color: white;
//     -webkit-box-shadow: none;
//     -webkit-user-select: none;
//     transition: none
// }

// .btn:hover {
//     color: white
// }

// a {
//     // color: black
// }

// a:hover {
//     // color: black;
//     text-decoration: none
// }

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

.fs5 {
  font-size: 5em;
  color: #CB3F5A;
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

.form-control {
    padding: 0.5rem !important;
    margin-bottom: 1rem !important;
}
</style>