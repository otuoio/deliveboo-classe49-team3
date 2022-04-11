<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            box-sizing: border-box;
            padding: 0;
        }
        body {
            font-family: 'Lato', sans-serif;
        }
        .navbar {
            height: 60px;
            background-color: #CB3F5A;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .logo h1 {
            color: white;
            margin-left: 4em;
            font-style: italic;
        }
        .general-container {
            width: 70%;
            margin: 3em auto 0 auto; 
        }
        .container {
            width: 100%;
            padding: 2em;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
        h3 {
            margin-bottom: 1em;
            font-size: 1.3em;
        }
        h4 {
            margin-bottom: 0.5em;
            font-size: 1.3em;
        }
        .name {
            font-size: 1.2em;
            margin: 1em 0 0.5em 0;
        }
        .address {
            font-size: 1.1em;
        }
        .email {
            margin: 0.3em 0;
        }
        .phone-number {
            margin-bottom: 1.3em;
        }
        .table {
            width: 100%;
            border-color: #dee2e6;
            border-collapse: collapse;
        }
        .table td {
            padding: 0.55rem;
            border-top: 1px solid #e9ecef;
        }
        .table th {
            padding: 0.55rem;
            border-top: 1px solid #e9ecef;
        }
        .table .b-none {
            border-top: transparent;
        }
        .table-light {
            background-color: #f8f9fa;
        }
        .table-light th {
            vertical-align: bottom;
            border-bottom: 2px solid #e9ecef;
        }
        /* logo */
        .body {
            position: absolute;
            top: 50%;
            margin-left: -145px;
            left: 50%;
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
        @media (max-width:768px) {
            .general-container {
                width: 100%;
            }
        }
        .center {
            text-align: center;
        }
        .order-title {
            margin-bottom: 2em;
        }
    </style> 
</head>
<body>
    <div class="navbar">
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
            <h1>Deliveboo</h1>
        </div>
    </div>
    <div class="general-container">
        <div class="container">
            <h4 class="order-title">Hai ricevuto un nuovo ordine, dovr&agrave; essere consegnato per le {{ $lead['arrivalTime']}}</h4>
            <h4 class="header-title mb-3">Informazioni del cliente: </h4>
            <div class="name">{{ $lead['orderInfo']['customer_name']}}</div>
            <div class="address">
                {{ $lead['orderInfo']['address']}}
            </div>
            <div class="contact">
                <div class="email">
                Email: {{ $lead['orderInfo']['email']}}
                </div>
                <div class="phone-number">
                Telefono: {{ $lead['orderInfo']['phone_number']}}
                </div>
            </div>
            <h4><strong>Riepilogo dell'ordine:</strong></h4>
            <div class="container-table">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="center">Prodotto</th>
                            <th class="center">Quantità</th>
                            <th class="center">Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lead['orderInfo']['cartDishes'] as $dish)
                        <tr>
                            <td class="b-none center">{{$dish['name']}}</td>
                            <td class="b-none center">{{$dish['quantity']}} </td>
                            <td class="b-none center"> {{ number_format($dish['price'], 2, ',', '.') }} &euro;</td>
                        </tr>
                        @endforeach
                        <tr class="table-light">
                            <td></td>
                            <td class="center"><strong>Totale ordine</strong></td>
                            <td class="center"><strong>{{ number_format($lead['orderInfo']['cartTotal'], 2, ',', '.') }} &euro;</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>