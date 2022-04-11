{{-- @dd($orders) --}}
@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('documentTitle')
    {{ $name }}
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa-solid fa-burger icon-gradient">
                            </i>
                        </div>
                        <div>Tutti gli ordini
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <div class="main-card mb-3 card">
                        <div class="card-body table-responsive">
                            <table class="mb-0 table table-hover" style="min-width: 600px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Data</th>
                                        <th class="text-center">Ora</th>
                                        <th class="text-center">Nome Cliente</th>
                                        <th class="text-center">Totale</th>
                                        <th class="text-center" colspan="3">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="align-middle text-center">{{ $order->date }}</td>
                                            <td class="align-middle text-center">
                                                {{ substr($order->time, 0, 5) }}
                                            </td>
                                            <td class="align-middle text-center">{{ $order->customer_name }}</td>
                                            <td class="align-middle text-center">
                                                {{ number_format($order->total, 2, ',', '.') }} &euro;</td>
                                            <td class="text-center">
                                                {{-- @if (Auth::user()->id === $dish->user_id) --}}
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#ModalShow{{ $order->id }}"
                                                    class="btn btn-primary text-white">
                                                    {{ __('Visualizza') }}
                                                </a>
                                                {{-- @endif --}}
                                            </td>
                                            @section('ordersPopup')
                                                @foreach ($orders as $order)
                                                    @include('partials.orderShowPopup')
                                                @endforeach
                                            @endsection
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
