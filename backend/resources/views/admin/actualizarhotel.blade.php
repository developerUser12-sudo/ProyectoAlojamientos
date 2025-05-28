@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Actualizar Hotel</h1>

        <div id="carouselExampleIndicators" class="carousel slide w-50 m-auto" data-ride="carousel">
            
            <div class="carousel-inner">
                @for ($i = 0; $i < count($hotel->imagenes); $i++)
                    @if ($i == 0)

                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ $hotel->imagenes[$i] }}"  alt="{{  $hotel->nombre }} slide">
                        </div>
                    @else

                        <div class="carousel-item ">
                            <img class="d-block w-100" src="{{ $hotel->imagenes[$i] }}"  alt="{{  $hotel->nombre }} slide">
                        </div>
                    @endif

                @endfor

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="color: white;">
                <span class="carousel-control-next-icon" aria-hidden="true" ></span>
            </a>
        </div>
        <form action="{{ route('admin.updatehotel', $hotel->id) }}" method="POST">
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
    <script>
        let numImagenesInput = document.getElementById('numImagenes');
        let imagenesContainer = document.getElementById('imagenesContainer');
        let numServiciosInput = document.getElementById('numServicios');
        let serviciosContainer = document.getElementById('serviciosContainer');
        const servicios = @json($hotel->servicios);
        const imagenes = @json($hotel->imagenes);
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
                    child.placeholder = `URL de la imagen ${index + 1}`;
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
                    if (index < servicios.length) {
                        child.value = servicios[index];
                    }
                    child.classList.add('form-control', 'mt-2');
                    child.placeholder = `Servicio ${index + 1}`;
                    serviciosContainer.appendChild(child);

                }
            }
        }
        function aniadirInputsServicios() {

            for (let index = 0; index < servicios.length; index++) {
                let child = document.createElement("input");
                child.type = 'text';
                child.name = 'servicios[]';
                child.value = servicios[index];
                child.classList.add('form-control', 'mt-2');
                child.placeholder = `Servicio ${index + 1}`;
                serviciosContainer.appendChild(child);
            }
        }
        function aniadirInputsImagenes() {

            for (let index = 0; index < imagenes.length; index++) {
                let child = document.createElement("input");
                child.type = 'text';
                child.name = 'imagenes[]';
                child.value = imagenes[index];
                child.classList.add('form-control', 'mt-2');
                child.placeholder = `URL de la imagen ${index + 1}`;
                imagenesContainer.appendChild(child);
            }
        }
        addEventListener('load', aniadirInputsServicios());
        addEventListener('load', aniadirInputsImagenes());


    </script>
@endsection