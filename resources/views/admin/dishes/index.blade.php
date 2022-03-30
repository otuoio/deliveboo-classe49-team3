@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('documentTitle')
    {{$name}}
@endsection

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
                    Piatti
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary text-white">Aggiungi un elemento al menu</a>
            </div>
        </div>
        <div class="row w-100">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Ultima modifica</th>
                        <th>Prezzo</th>
                        <th>Visibile</th>
                        <th colspan="3" class="text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <td class="align-middle">{{ $dish->id }}</td>
                            <td class="text-capitalize align-middle">{{ $dish->name }}</td>
                            <td class="align-middle">{{ $dish->updated_at }}</td>
                            <td class="align-middle">{{ number_format($dish->price, 2, ',', '.') }} &euro;</td>
                            <td class="align-middle">
                                @if ($dish->visible == 1)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary" href="{{ route('admin.dishes.show', $dish->slug) }}">Visualizza</a>
                            </td>
                            <td class="text-center">
                                @if (Auth::user()->id === $dish->user_id)
                                    <a class="btn btn-info"
                                        href="{{ route('admin.dishes.edit', $dish->slug) }}">Modifica</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (Auth::user()->id === $dish->user_id)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$dish->id}}" class="btn btn-danger">
                                    {{__('Elimina')}}
                                </a>
                                @endif
                            </td>
                            @include('partials.dishDeletePopup')
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                {{ $dishes->links() }}
            </div>
        </div>
    </div>
@endsection