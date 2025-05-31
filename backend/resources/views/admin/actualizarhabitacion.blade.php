@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Actualizar Habitacion</h1>

        <form action="{{ route('admin.updatehabitacion', $habitacion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="disponibles" value="{{ old('disponibles', $habitacion->disponibles) }}">
            <div class="mb-3">
                <label for="tipo_habitacion" class="form-label">Tipo habitacion</label>
                <input type="text" name="tipo_habitacion" class="form-control" required
                    value="{{ old('tipo_habitacion', $habitacion->tipo_habitacion) }}">
            </div>

            <div class="mb-3">
                <label for="precio_original_noche" class="form-label">Precio</label>
                <input type="number" name="precio_original_noche" class="form-control" required
                    value="{{ old('precio_original_noche', $habitacion->precio_original_noche) }}">
            </div>

            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" name="capacidad" class="form-control" required
                    value="{{ old('capacidad', $habitacion->capacidad) }}">
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" name="total" class="form-control" required
                    value="{{ old('total', $habitacion->total) }}">
            </div>

            <div class="mb-3">
                <label for="descuento" class="form-label">Descuento</label>
                <input type="number" name="descuento" id="descuento" class="form-control"
                    value="{{ old('descuento', $habitacion->descuento) }}" required>

            </div>

            <div id="serviciosContainer" class="mb-3"></div>
            <div class="mb-3">
                <label for="numImagenes" class="form-label">Imágenes (Max 10)</label>
                <input type="number" id="numImagenes" class="form-control" min="1" max="10" oninput="aniadirInputImagen()"
                    value="{{ count($habitacion->imagenes) }}" required>

            </div>
            <div id="imagenesContainer" class="mb-3"></div>

            <button type="submit" class="btn btn-primary">Actualizar Habitacion</button>
        </form>
        <form action="{{ route('admin.paneladministracion') }}">
            <input type="submit" value="Volver" class="btn btn-secondary mt-3">
        </form>
    </div>
    <script>
        let numImagenesInput = document.getElementById('numImagenes');
        let imagenesContainer = document.getElementById('imagenesContainer');
        let imagenes = @json($habitacion->imagenes);
        function aniadirInputImagen() {
            imagenesContainer.innerHTML = '';
            if (numImagenesInput.value <= 10) {
                for (let index = 0; index < numImagenesInput.value; index++) {
                    let child = document.createElement("input");
                    child.type = 'text';
                    if (index < imagenes.length) {
                        child.value = imagenes[index];
                    }
                    
                    child.name = 'imagenes[]';
                    child.classList.add('form-control', 'mt-2');
                    child.required=true;
                    child.placeholder = `URL de la imagen ${index + 1}`;
                    imagenesContainer.appendChild(child);

                }
            }
        }
        function aniadirInputsImagenes() {

            for (let index = 0; index < imagenes.length; index++) {
                let child = document.createElement("input");
                child.type = 'text';
                child.name = 'imagenes[]';
                child.value = imagenes[index];
                 child.required = true;
                child.classList.add('form-control', 'mt-2');
                child.placeholder = `URL de la imagen ${index + 1}`;
                imagenesContainer.appendChild(child);
            }
        }
        addEventListener('load', aniadirInputsImagenes);
    </script>

@endsection