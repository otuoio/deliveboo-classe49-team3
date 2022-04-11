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
                        <div>Tutti i piatti
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
                <div class="col mb-3">
                    <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary text-white">Aggiungi un elemento
                        al menu</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="main-card mb-3 card">
                        <div class="card-body table-responsive">
                            <table class="mb-0 table table-hover" style="min-width: 820px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nome</th>
                                        <th class="text-center">Ultima modifica</th>
                                        <th class="text-center">Prezzo</th>
                                        <th class="text-center">Visibile</th>
                                        <th colspan="3" class="text-center">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes as $dish)
                                        <tr>
                                            <td class="align-middle text-center">{{ $dish->name }}</td>
                                            <td class="align-middle text-center">{{ $dish->updated_at }}</td>
                                            <td class="align-middle text-center">
                                                {{ number_format($dish->price, 2, ',', '.') }} &euro;</td>
                                            <td class="align-middle text-center">
                                                @if ($dish->visible == 1)
                                                    Sì
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td class="text-center d-flex">
                                                <div class="d-inline-block table-div">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.dishes.show', $dish->slug) }}">Visualizza</a>
                                                </div>
                                                <div class="d-inline-block table-div">
                                                    @if (Auth::user()->id === $dish->user_id)
                                                        <a class="btn btn-show"
                                                            href="{{ route('admin.dishes.edit', $dish->slug) }}">Modifica</a>
                                                    @endif
                                                </div>
                                                <div class="d-inline-block table-div">
                                                    @if (Auth::user()->id === $dish->user_id)
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#ModalDelete{{ $dish->id }}"
                                                            class="btn btn-danger">
                                                            {{ __('Elimina') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            @section('dishesPopup')
                                                @foreach ($dishes as $dish)
                                                    @include('partials.dishDeletePopup')
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
