<form>
    <div class="modal fade" id="ModalShow{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Dettaglio ordine
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <h4 class="header-title mb-3">Informazioni del cliente</h4>
                                    <h5>{{ $order->customer_name }}</h5>
                                    <address class="mb-0 font-14 address-lg">
                                        {{ $order->address }} <br>
                                        <div class="mt-2">
                                            Email: {{ $order->email }} <br>
                                            Telefono: {{ $order->phone_number }}
                                        </div>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <h4 class="header-title mb-3">Piatti ordinati</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Prodotto</th>
                                                    <th>Quantità</th>
                                                    <th>Prezzo</th>
                                                    <th>Totale</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->dishes()->withTrashed()->get()
    as $dish)
                                                    <tr>
                                                        <td>{{ $dish->name }}</td>
                                                        <td>{{ $dish->pivot->qty }}</td>
                                                        <td>{{ number_format($dish->price, 2, ',', '.') }} &euro;</td>
                                                        <td>{{ number_format($dish->price * $dish->pivot->qty, 2, ',', '.') }}
                                                            &euro;</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="table-light">
                                                    <td colspan="3"><strong>Totale ordine</strong></td>
                                                    <td><strong>{{ number_format($order->total, 2, ',', '.') }}
                                                            &euro;</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">
                        {{ __('Chiudi') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
