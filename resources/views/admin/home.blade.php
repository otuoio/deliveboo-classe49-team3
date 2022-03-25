@extends('layouts.admin')

@section('documentTitle')
    Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Statistiche') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __("Hai effettuato l'accesso con successo!") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
