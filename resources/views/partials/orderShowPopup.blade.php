<form>
    <div class="modal fade" id="ModalDelete{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Dettaglio ordine
                    </h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Nome: {{$order->customer_name}}</li>
                        <li>E-mail: {{$order->email}}</li>
                        <li>Indirizzo: {{$order->address}}</li>
                        <li>Numero di telefono: {{$order->phone_number}}</li>
                        <li>Dettaglio piatti:</li>
                        <ul>
                            @foreach ($order->dishes()->withTrashed()->get() as $dish)
                            <li>{{$dish->name}}: {{ number_format($dish->price, 2, ',', '.') }} &euro;</li>
                            <li>Quantità: {{$dish->pivot->qty}}</li>
                            @endforeach
                        </ul>
                        <li>Totale ordine: {{ number_format($order->total, 2, ',', '.') }} &euro;</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">
                        {{__('Chiudi')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
