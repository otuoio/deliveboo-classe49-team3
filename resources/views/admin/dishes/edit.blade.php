@extends('layouts.admin')

@section('documentTitle')
  {{$name}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{route('admin.dishes.update', $dish)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- {{-- select nel caso in cui volessimo aggiungere le categorie dei piatti --}}
                {{-- <div class="mb-3">
                    <select class="form-select" name="category_id">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}} -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $dish->name) }}" >
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo</label>
                    <input type="number" step="0.01"  class="form-control" id="price" name="price" value="{{ old('price', $dish->price) }}" required min="0.01" placeholder="&euro;">
                    @error('price')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="description" rows="3"
                        name="description">{{ old('description', $dish->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                        @if (!empty($dish->image))
                            <img src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}">
                        @else
                            <img class="img-fluid" src="{{ asset('storage/uploads/default/default_dish.jpg')}}" alt="{{ $dish->name }}">
                        @endif
                    </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Inserisci l'immagine</label>
                    <input class="form-control" type="file" id="image" name="image">
                    @error('image')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <fieldset class="mb-3">
                    <label for="name" class="form-label">Tag</label>
                        Vegan
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vegan" id="vegan1" value="1" {{ (old('vegan', $dish->vegan) == 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="vegan1">
                                Sì
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vegan" id="vegan2" value="0" {{ (old('vegan', $dish->vegan) == 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="vegan2">
                                No
                            </label>
                        </div>

                        Piccante
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="spicy" id="spicy1" value="1" {{ (old('spicy', $dish->spicy) == 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="spicy1">
                                Sì
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="spicy" id="spicy2" value="0" {{ (old('spicy', $dish->spicy) == 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="spicy2">
                                No
                            </label>
                        </div>
<!-- {{-- {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} --}} -->
                </fieldset>
                <div class="mb-3">
                        Visibile
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visible" id="visible1" value="1" {{ (old('visible', $dish->visible) == 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible1">
                                Sì
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visible" id="visible2" value="0" {{ (old('visible', $dish->visible) == 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible2">
                                No
                            </label>
                        </div>

                        <!-- {{-- <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="visible" value="">
                            <label class="form-check-label" for="visible">Visibilità</label>
                        </div> --}} -->



                        <!-- {{-- <input class="form-check-input" type="checkbox" value="{{ old('visible') }}" name="visible">
                        {{-- {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} --}}
                        {{-- <label class="form-check-label" for="flexCheckDefault">
                            Visibile
                        </label> --}} -->
                    
                </div>
          
                <!-- passare l'id dell'user in modalità nascosta -->
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                <input class="btn btn-primary" type="submit" value="Salva">
                </form>
            </div>
        </div>
    </div>
@endsection