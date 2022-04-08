<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <title>Document</title>
    {{-- <style>
        /* CARRELLO */
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

         /* img {
             width: 3.5rem
         } */

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
    </style> --}}
</head>

<body>
    <div class="row">
        <div class="col">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="confirmation">
                        {{-- <img class="img-fluid" src="https://cdn.dribbble.com/users/338126/screenshots/14926319/media/20b64b8c929f2cad121aae5f0d02e08c.gif" alt=""> --}}
                        <h4 class="header-title mb-3">Il tuo ordine arriver&agrave; per le {{ $lead['arrivalTime'] }}
                        </h4>
                    </div>
                    <div class="mt-5">
                        <h3>Ottime notizie! {{ $lead['restaurantName'] }} ha confermato il tuo ordine.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-4">
            <div class="card m-0 ms-4">
                <div class="row">
                    <div class="col-md-12 cart">
                        <div class="title">
                            <div class="row">
                                <div class="col d-flex justify-content-between align-items-center">
                                    <h4 class="cart-title"><strong>Riepilogo dell'ordine</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div>
                            @foreach ($lead['orderInfo']['cartDishes'] as $dish)
                                <div class="row border-top border-bottom">
                                    <div class="row main align-items-center">
                                        <div class="col">
                                            <div class="row">{{ $dish['name'] }}</div>
                                        </div>
                                        <div class="col">
                                            <span class="d-inline-block border">{{ $dish['quantity'] }}</span>
                                        </div>
                                        <div class="col">&euro;
                                            {{ number_format($dish['price'], 2, ',', '.') }} &euro;
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                <div class="col"> <b>TOTALE</b> </div>
                                <div class="col offset-4 text-right">&euro;
                                    {{ number_format($lead['orderInfo']['cartTotal'], 2, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
