@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-secondary">
                <div class="card-header">{{ __('Cambiar correo electrónico') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('email.change.request') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="current_email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Correo actual') }}
                            </label>
                            <div class="col-md-6">
                                <input id="current_email" type="email" class="form-control" 
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="new_email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Nuevo correo electrónico') }}
                            </label>
                            <div class="col-md-6">
                                <input id="new_email" type="email" class="form-control" 
                                    name="new_email" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                {{ __('Contraseña') }}
                            </label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" 
                                    name="password" required>
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Solicitar cambio de correo') }}
                                </button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
