@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mi cuenta') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('account.update.username') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   value="{{ old('username', auth()->user()->name) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar nombre</button>
                    </form>

                    <hr>

                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar correo</button>
                    </form>

                    <hr>

                    {{-- Cambiar contraseña --}}
                    <form method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña actual</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva contraseña</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
                    </form>

                    <hr>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
