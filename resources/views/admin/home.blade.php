@extends('layouts.admin')

@section('documentTitle')
    Dashboard
@endsection

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa-solid fa-chart-line icon-gradient">
                            </i>
                        </div>
                        <div>Statistiche
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xxl-3">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading fw-normal">Vendite totali</div>
                                {{-- <div class="widget-subheading"></div> --}}
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span id="totalSells"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-3">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading fw-normal">Ordini del mese</div>
                                {{-- <div class="widget-subheading">Totale ordini di questo mese</div> --}}
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span id="orderMonth"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-3">
                    <div class="card mb-3 widget-content bg-grow-early">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading fw-normal">Ordini di quest'anno</div>
                                {{-- <div class="widget-subheading">Totale ordini di quest'anno</div> --}}
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span id="orderYear"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-lg-block col-md-6 col-xxl-3">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading fw-normal">Vendite del mese</div>
                                {{-- <div class="widget-subheading">Vendite del mese corrente</div> --}}
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span id="totalSellsThisMonth"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>Statistiche</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        // recupero i dati degli ordini passando il dato php in js
        let ordersData = ({!! json_encode($ordersData->toArray()) !!}).data;

        let dataOrdersNumbers = [
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ];
        let totalSells = 0;
        let totalSellsMonth = 0;

        let today = new Date();
        let totalOrdersCurrentMonth = 0;
        let totalOrdersCurrentYear = 0;


        ordersData.forEach(element => {

            // ad ogni elemento aggiorno il totale delle vendite
            totalSells += element.total;

            let orderDate = new Date(element.date);
            let monthIndex = orderDate.getMonth();
            let year = orderDate.getYear();

            // numero ordini per mese per l'anno corrente
            if ((orderDate.getYear() + 1900) == (today.getYear() + 1900)) {
                for (let i = 0; i < 11; i++) {
                    // riempimento dell'array per i dati del grafico vendite per mese   
                    if (monthIndex == i) {
                        dataOrdersNumbers[i]++;
                    }
                }
            }

            if (today.getMonth() == monthIndex) {
                // reimpimento del total order per month
                totalOrdersCurrentMonth++;
                //riempimento totale per mese
                totalSellsMonth += element.total
            }

            // reimpimento del total order per year
            if (today.getYear() == year) {
                totalOrdersCurrentYear++;
            }
        });

        const orderMonth = document.getElementById('orderMonth');
        const orderYear = document.getElementById('orderYear');
        const totalSellsSpan = document.getElementById('totalSells');
        const totalSellsThisMonth = document.getElementById('totalSellsThisMonth');

        orderMonth.innerHTML = totalOrdersCurrentMonth;
        orderYear.innerHTML = totalOrdersCurrentYear;
        totalSellsSpan.innerHTML = "&euro;" + totalSells.toFixed(2);
        totalSellsThisMonth.innerHTML = "&euro;" + totalSellsMonth.toFixed(2);

        const ctx = document.getElementById('myChart').getContext('2d');
        const xlabels = [];
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Gennaio',
                    'Febbraio',
                    'Marzo',
                    'Aprile',
                    'Maggio',
                    'Giugno',
                    'Luglio',
                    'Agosto',
                    'Settembre',
                    'Ottobre',
                    'Novembre',
                    'Dicembre'
                ],
                datasets: [{
                    label: 'Numero di ordini ',
                    data: dataOrdersNumbers,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
