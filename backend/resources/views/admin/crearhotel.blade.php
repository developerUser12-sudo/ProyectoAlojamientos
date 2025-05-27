@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Crear Hotel</h1>
        <form action="{{ route('admin.createhotel') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="localizacion" class="form-label">Localización</label>
            <input type="text" id="localizacion" name="localizacion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estrellas" class="form-label">Estrellas</label>
            <input type="number" id="estrellas" name="estrellas" class="form-control" required min="0" max="5" step="1">
        </div>

        <div class="mb-3">
            <label for="numServicios" class="form-label">Servicios (Max 10)</label>
            <input type="number" id="numServicios" class="form-control" min="1" max="10" oninput="aniadirInputServicio()">
        </div>

        <div id="serviciosContainer" class="mb-3"></div>
        <div class="mb-3">
            <label for="numImagenes" class="form-label">Imágenes (Max 10)</label>
            <input type="number" id="numImagenes" class="form-control" min="1" max="10" oninput="aniadirInputImagen()">
        </div>
        <div id="imagenesContainer" class="mb-3"></div>

        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" id="capacidad" name="capacidad" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="hora_apertura" class="form-label">Hora Apertura</label>
            <input type="time" id="hora_apertura" name="hora_apertura" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora_cierre" class="form-label">Hora Cierre</label>
            <input type="time" id="hora_cierre" name="hora_cierre" class="form-control" required>
        </div>



        <button type="submit" class="btn btn-primary">Crear Coche</button>
        </form>
      

        <form action="{{ route('admin.paneladministracion') }}">
            <input type="submit" value="Volver" class="btn btn-secondary">
        </form>
    </div>
    <script>
        let numImagenesInput = document.getElementById('numImagenes');
        let imagenesContainer = document.getElementById('imagenesContainer');
        let numServiciosInput = document.getElementById('numServicios');
        let serviciosContainer = document.getElementById('serviciosContainer');
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
        function aniadirInputServicio() {
            serviciosContainer.innerHTML = '';
            if (numServiciosInput.value <= 10) {
                for (let index = 0; index < numServiciosInput.value; index++) {
                    let child = document.createElement("input");
                    child.type = 'text';
                    child.name = 'servicios[]';
                    child.classList.add('form-control', 'mt-2');
                    child.placeholder = `Servicio ${index + 1}`;
                     child.required = true;
                    serviciosContainer.appendChild(child);

                }
            }
        }

    </script>
@endsection
</body>

</html>