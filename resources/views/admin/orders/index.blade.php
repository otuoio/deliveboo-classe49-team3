{{-- @dd($orders) --}}
@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
{{-- 
@section('documentTitle')
    {{$name}}
@endsection --}}

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    Ordini
                </h1>
            </div>
        </div>
        
        <div class="row w-100">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >Num ordine</th>
                        <th >Data</th>
                        <th >Ora</th>
                        <th >Nome Cliente</th>
                        <th >Totale</th>
                        <th class="d-flex justify-content-center">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">{{ $order->id }}</td>
                            <td class="align-middle">{{ $order->date }}</td>
                            <td class="align-middle">{{ $order->time }}</td>
                            <td class="align-middle">{{ $order->customer_name }}</td>
                            <td class="align-middle">{{ number_format($order->total, 2, ',', '.') }} &euro;</td>
                            <td class="d-flex justify-content-center">
                                {{-- @if (Auth::user()->id === $dish->user_id) --}}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$order->id}}" class="btn btn-primary">
                                    {{__('Visualizza')}}
                                </a>
                                {{-- @endif --}}
                            </td>
                            @include('partials.orderShowPopup')
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="row">
            <div class="col d-flex justify-content-center">
                {{ $dishes->links() }}
            </div>
        </div> --}}
    </div>
@endsection