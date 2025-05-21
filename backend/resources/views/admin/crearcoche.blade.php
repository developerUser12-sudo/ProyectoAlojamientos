@extends('layouts.app')

@section('content')
<div class="container">
   
        <h1>Crear Coche</h1>

        <form action="{{ route('admin.createcoche') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" name="origen" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="text" name="imagen" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" required min="1">
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" class="form-control" required min="1">
        </div>
        <div class="mb-3">
            <label for="descuento" class="form-label">Descuento</label>
            <input type="number" name="descuento" class="form-control" required min="0">
        </div>

        <button type="submit" class="btn btn-primary">Crear Coche</button>
    </form>
    <form action="{{ route('admin.paneladministracion') }}">
        <input type="submit" value="Volver" class="btn btn-secondary">
    </form>
</div>
@endsection
</body>

</html>