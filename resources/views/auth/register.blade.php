@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="{{ asset('js/checkboxValidation.js') }}" defer></script>
@endsection

@section('documentTitle')
    Registrazione
@endsection

@section('content')
    <div class="app-container body-tabs-shadow fixed-sidebar fixed-header">
        @include('partials.navbarLogin')
        <div class="app-main">
            <div class="app-main__outer p-0 py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Registrazione') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                    @error('categories')
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <fieldset class="mb-3">
                                        <legend>Seleziona una o più categorie per il tuo ristorante</legend>
                                        <div class="checkboxs-wrapper d-flex flex-wrap" style="column-gap: 3em;">
                                            <input id="radio-for-checkboxes" type="radio"
                                                name="radio-for-required-checkboxes"
                                                {{ old('radio-for-required-checkboxes') ? 'checked' : '' }} required />
                                            @foreach ($categories as $category)
                                                <div class="form-check my-form-check">
                                                    <input class="form-check-input validationCB" id="{{ $category->id }}"
                                                        type="checkbox" value="{{ $category->id }}" name="categories[]"
                                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </fieldset>

                                    <div class="form-group row mb-2">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Nome attività*') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail*') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password*') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="address"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo*') }}</label>

                                        <div class="col-md-6">
                                            <input id="address" type="text"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                value="{{ old('address') }}" required autocomplete="address" autofocus>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="p_iva"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Partita Iva*') }}</label>

                                        <div class="col-md-6">
                                            <input id="p_iva" type="text" minlength="11"
                                                class="form-control @error('p_iva') is-invalid @enderror" name="p_iva"
                                                value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus>

                                            @error('p_iva')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="phone_number"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Numero di telefono*') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone_number" type="text" pattern="[0-9]{8,12}"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" value="{{ old('phone_number') }}" required
                                                autocomplete="phone_number" autofocus>

                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="shipment_price"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Costo consegna*') }}</label>

                                        <div class="col-md-6">
                                            <input id="shipment_price" type="number" step="0.01"
                                                class="form-control @error('shipment_price') is-invalid @enderror"
                                                name="shipment_price" value="{{ old('shipment_price') }}" required
                                                min="0.01" autocomplete="shipment_price" autofocus>

                                            @error('shipment_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="image"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Immagine') }}</label>

                                        <div class="col-md-6">
                                            <input class="form-control" type="file" id="image" name="image">

                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Registrati') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
