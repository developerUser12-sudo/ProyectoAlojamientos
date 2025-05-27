@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Crear Habitacion</h1>

        <form action="{{ route('admin.createhabitacion') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="hotel_id" class="form-control" value="{{ $hotel->id }}">
            </div>
            <div class="mb-3">
                <label for="tipo_habitacion" class="form-label">Tipo habitacion</label>
                <input type="text" id="tipo_habitacion" name="tipo_habitacion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="precio_noche" class="form-label">Precio por noche</label>
                <input type="number" id="precio_noche" name="precio_noche" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" id="capacidad" name="capacidad" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="disponibles" class="form-label">Disponibles</label>
                <input type="text" id="disponibles" name="disponibles" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="numImagenes" class="form-label">Imágenes (Max 10)</label>
                <input type="number" id="numImagenes" class="form-control" min="1" max="10" oninput="aniadirInputImagen()">
            </div>
            <div id="imagenesContainer" class="mb-3"></div>


            <button type="submit" class="btn btn-primary">Crear Coche</button>
        </form>
        <form action="{{ route('admin.paneladministracion') }}">
            <input type="submit" value="Volver" class="btn btn-secondary">
        </form>
    </div>
    <script>
        let numImagenesInput = document.getElementById('numImagenes');
        let imagenesContainer = document.getElementById('imagenesContainer');
        function aniadirInputImagen() {
            imagenesContainer.innerHTML = '';
            if (numImagenesInput.value <= 10) {
                for (let index = 0; index < numImagenesInput.value; index++) {
                    let child = document.createElement("input");
                    child.type = 'text';
                    child.name = 'imagenes[]';
                    child.classList.add('form-control', 'mt-2');
                    child.placeholder = `URL de la imagen ${index + 1}`;
                    child.required = true;
                    imagenesContainer.appendChild(child);

                }
            }
        }
    </script>
@endsection
</body>

</html>