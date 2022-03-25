@extends('layouts.admin')

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
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('storage/' . $dish->image)}}" alt="{{ $dish->name }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary mt-3" href="{{ route('admin.dishes.index') }}">Go Back</a>
            </div>
        </div>
    </div>
@endsection