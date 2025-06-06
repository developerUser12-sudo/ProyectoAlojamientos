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
                        <br>
                        @if(session('nombreActualizado'))
                            <div id="nombreActualizado" class="alert alert-success" style="position: relative; padding-right: 40px;">
                                {{ session('nombreActualizado') }}
                                <button onclick="document.getElementById('nombreActualizado').remove()"
                                    style="position:absolute;right:15px; background: none; border: none; font-weight: bold; font-size: 17px; cursor: pointer;">
                                    ×
                                </button>
                            </div>
                        @endif

                        <hr>

                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', auth()->user()->email) }}" required readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar correo</button>
                        </form>

                        <hr>

                        <form method="GET" action="{{ route('password.request') }}">
                            @csrf
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