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
                        <div> Crea un nuovo piatto
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form class="" action="{{ route('admin.dishes.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="position-relative row form-group">
                                    <label for="exampleEmail" class="col-sm-2 col-form-label">Nome*</label>
                                    <div class="col-sm-10">
                                        <input id="name" name="name" placeholder="Inserisci il nome" required
                                            value="{{ old('name') }}" type="text" class="form-control">
                                        @error('name')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="price" class="col-sm-2 col-form-label">Prezzo*</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                                            value="{{ old('price') }}" required min="0.01" placeholder="&euro;">
                                        @error('price')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}
                                    </textarea>
                                        @error('description')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="image" class="col-sm-2 col-form-label">Inserisci l'immagine</label>
                                    <div class="col-sm-10">
                                        <input name="image" id="image" type="file" class="form-control">
                                        @error('image')
                                            <div class="alert alert-danger mt-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <fieldset class="position-relative row form-group">
                                    <legend class="col-form-label col-sm-2">Vegano*</legend>
                                    <div class="col-sm-10">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label" for="vegan1">
                                                <input type="radio" class="form-check-input" name="vegan" id="vegan1"
                                                    value="1" {{ old('vegan') == 1 ? 'checked' : '' }}>Sì
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label" for="vegan2">
                                                <input type="radio" class="form-check-input" name="vegan" id="vegan2"
                                                    value="0" {{ old('vegan') == 0 ? 'checked' : '' }}>No
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="position-relative row form-group">
                                    <legend class="col-form-label col-sm-2">Piccante*</legend>
                                    <div class="col-sm-10">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label" for="spicy1">
                                                <input type="radio" class="form-check-input" name="spicy" id="spicy"
                                                    value="1" {{ old('spicy') == 1 ? 'checked' : '' }}>Sì
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label" for="spicy2">
                                                <input type="radio" class="form-check-input" name="spicy" id="spicy2"
                                                    value="0" {{ old('spicy') == 0 ? 'checked' : '' }}>No
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="position-relative row form-group">
                                    <legend class="col-form-label col-sm-2">Visibile*</legend>
                                    <div class="col-sm-10">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label" for="visible1">
                                                <input type="radio" class="form-check-input" name="visible" id="visible1"
                                                    value="1" {{ old('visible') == 1 ? 'checked' : '' }}>Sì
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label" for="visible2">
                                                <input type="radio" class="form-check-input" name="visible" id="visible2"
                                                    value="0" {{ old('visible') == 0 ? 'checked' : '' }}>No
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="position-relative row form-group mb-0">
                                    <div class="col-form-label col-sm-10">
                                        <input class="btn btn-primary me-2" type="submit" value="Salva">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
