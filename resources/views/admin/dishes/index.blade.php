@extends('layouts.admin')

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
                <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">Aggiungi un elemento al menu</a>
            </div>
        </div>
        <div class="row w-100">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ultima modifica</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Visibile</th>
                        <th colspan="3" scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <td>{{ $dish->id }}</td>
                            <td class="text-capitalize">{{ $dish->name }}</td>
                            <td>{{ $dish->updated_at }}</td>
                            <td>{{ number_format($dish->price, 2, ',', '.') }} &euro;</td>
                            <td>
                                @if ($dish->visible == 1)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td><a class="btn btn-primary" href="{{ route('admin.dishes.show', $dish->slug) }}">Visualizza</a>
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
                            @include('partials.delete')
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