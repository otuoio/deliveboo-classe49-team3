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
                        <th scope="col">Id</th>
                        <th scope="col">Data</th>
                        <th scope="col">Ora</th>
                        <th scope="col">Nome Cliente</th>
                        <th scope="col">Totale</th>
                        {{-- <th colspan="3" scope="col">Azioni</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->time }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ number_format($order->total, 2, ',', '.') }} &euro;</td>
                           
                            {{-- <td><a class="btn btn-primary" href="{{ route('admin.dishes.show', $dish->slug) }}">Visualizza</a>
                            </td>
                            <td>
                                @if (Auth::user()->id === $dish->user_id)
                                    <a class="btn btn-info"
                                        href="{{ route('admin.dishes.edit', $dish->slug) }}">Modifica</a>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->id === $dish->user_id)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$dish->id}}" class="btn btn-danger">
                                    {{__('Elimina')}}
                                </a>
                                @endif
                            </td>
                            @include('partials.dishDeletePopup') --}}
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