@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('documentTitle')
    {{ $name }}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa-solid fa-burger icon-gradient">
                            </i>
                        </div>
                        <div> Dettaglio del piatto
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <div class="main-card mb-3 card h-100">
                        <div class="card-body">
                            <div class="row row-cols-2 h-100">
                                <div class="col-12 col-md-7 col-lg-6 d-flex flex-column justify-content-between">
                                    <h5 class="card-title">{{ $dish->name }}</h5>
                                    <h6 class="card-subtitle">
                                        @if ($dish->vegan == 1)
                                            <i class="fa-solid fa-check"></i> Vegano
                                        @else
                                            <i class="fa-solid fa-xmark"></i> Vegano
                                        @endif
                                        @if ($dish->spicy == 1)
                                            <i class="fa-solid fa-check ms-3"></i> Piccante
                                        @else
                                            <i class="fa-solid fa-xmark ms-3"></i> Piccante
                                        @endif
                                        @if ($dish->visible == 1)
                                            <i class="fa-solid fa-check ms-3"></i> Visibile
                                        @else
                                            <i class="fa-solid fa-xmark ms-3"></i> Visibile
                                        @endif
                                    </h6>
                                    <p class="mt-3 card-description">{{ $dish->description }}.</p>
                                    <p class="mt-3 card-description">Prezzo:
                                        {{ number_format($dish->price, 2, ',', '.') }} &euro;</p>
                                    <div class="button-box">
                                        <a href="{{ route('admin.dishes.index') }}">
                                            <button class="btn btn-primary">Torna alla lista dei piatti</button>
                                        </a>
                                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="ms-0 ms-sm-3">
                                            <button class="btn btn-show">Modifica</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 col-lg-6">
                                    @if ($dish->image)
                                        <img width="100%" class="img-fluid"
                                            src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
                                    @else
                                        <img width="100%" class="img-fluid"
                                            src="{{ asset('storage/uploads/default/default_dish.jpg') }}"
                                            alt="{{ $dish->name }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
