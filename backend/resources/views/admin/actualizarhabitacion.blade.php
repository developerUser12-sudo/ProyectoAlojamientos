@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Actualizar Habitacion</h1>

        <form action="{{ route('admin.updatehabitacion', $hotel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required value="{{ old('nombre', $hotel->nombre) }}">
            </div>

            <div class="mb-3">
                <label for="localizacion" class="form-label">Localizacion</label>
                <input type="text" name="localizacion" class="form-control" required
                    value="{{ old('localizacion', $hotel->localizacion) }}">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" name="direccion" class="form-control" required
                    value="{{ old('direccion', $hotel->direccion) }}">
            </div>

            <div class="mb-3">
                <label for="estrellas" class="form-label">Estrellas</label>
                <input type="number" name="estrellas" class="form-control" required
                    value="{{ old('estrellas', $hotel->estrellas) }}">
            </div>

            <div class="mb-3">
                <label for="numServicios" class="form-label">Servicios (Max 10)</label>
                <input type="number" id="numServicios" class="form-control" min="1" max="10"
                    oninput="aniadirInputServicio()" value="{{ count($hotel->servicios) }}" required>

            </div>

            <div id="serviciosContainer" class="mb-3"></div>
            <div class="mb-3">
                <label for="numImagenes" class="form-label">Imágenes (Max 10)</label>
                <input type="number" id="numImagenes" class="form-control" min="1" max="10" oninput="aniadirInputImagen()"
                    value="{{ count($hotel->imagenes) }}" required>

            </div>
            <div id="imagenesContainer" class="mb-3"></div>
            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" name="capacidad" class="form-control" required min="1 "
                    value="{{ old('capacidad', $hotel->capacidad) }}">
            </div>
            <div class="mb-3">
                <label for="hora_apertura" class="form-label">Fecha apertura</label>
                <input type="time" name="hora_apertura" class="form-control" required
                    value="{{ old('hora_apertura', $hotel->hora_apertura) }}">
            </div>
            <div class="mb-3">
                <label for="hora_cierre" class="form-label">Fecha cierre</label>
                <input type="time" name="hora_cierre" class="form-control" required
                    value="{{ old('hora_cierre', $hotel->hora_cierre) }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Hotel</button>
        </form>
        <form action="{{ route('admin.paneladministracion') }}">
            <input type="submit" value="Volver" class="btn btn-secondary mt-3">
        </form>
    </div>
    
@endsection