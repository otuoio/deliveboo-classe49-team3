@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('documentTitle')
    {{$name}}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-capitalize">{{ $dish->name }}</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div>{{ $dish->description }}</div>
                <div><span>Vegano:
                    @if ($dish->vegan == 1)
                        Si
                    @else
                        No
                    @endif 
                    </span>
                </div>
                <div><span>Piccante:
                    @if ($dish->spicy == 1)
                        Si
                    @else
                        No
                    @endif 
                    </span>
                </div>
                <div><span>Visibile:
                    @if ($dish->visible == 1)
                        Si
                    @else
                        No
                    @endif 
                    </span>
                </div>
                <div>{{ number_format($dish->price, 2, ',', '.') }} &euro;</div>
            </div>
            <div class="col">
                @if ($dish->image)
                    <img class="img-fluid" src="{{ asset('storage/' . $dish->image)}}" alt="{{ $dish->name }}">
                @else
                    <img class="img-fluid" src="{{ asset('storage/uploads/default/default_dish.jpg')}}" alt="{{ $dish->name }}">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary mt-3" href="{{ route('admin.dishes.index') }}">Torna Indietro</a>
            </div>
        </div>
    </div>
@endsection