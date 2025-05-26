@extends('layouts.app')

@section('content')
<div class="container-xxl d-flex flex-column gap-3">

    <div class="card w-100">

        <div class="card-header">{{ __('Coches') }}</div>

        <div class="card-body d-flex flex-column gap-2 table-responsive">

            <form method="GET" action="{{ route('admin.crearcoche') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Crear coche
                </button>
            </form>
            <br>
            <table class="table">
                <tr>
                    <th>Imagen y precio</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Disponibles</th>
                    <th>Total</th>
                    <th>Descuento</th>
                </tr>
                @foreach ($coches as $coche)
                <tr>
                    <td><img src="{{ $coche->imagen }}" alt="Imagen coche" class="img-fluid w-50" style="min-width:130px;"><br><b
                            class="text-center"> {{ $coche->precio }}€</b></td>
                    <td>
                        <p> {{ $coche->origen }}</p>
                    </td>
                    <td>
                        <p> {{ $coche->destino }}</p>
                    </td>
                    <td>
                        <p> {{ $coche->marca }}</p>
                    </td>
                    <td>
                        <p> {{ $coche->modelo }}</p>
                    </td>
                    <td>
                        <p> {{ $coche->disponibles }}</p>
                    </td>
                    <td>
                        <p> {{ $coche->total }}</p>
                    </td>
                    <td>
                        <p> {{ $coche->descuento }}</p>
                    </td>
                    <td>
                        <div class="ms-auto d-flex flex-md-row flex-column gap-2">
                            <form action="{{ route('admin.actualizarcoche', $coche->id) }}">
                                <input type="submit" class="btn btn-warning" value="Editar">
                            </form>
                            <form action="{{ route('admin.deletecoche', $coche->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </table>
            <div>
                {{ $coches->links() }}
            </div>

        </div>
    </div>
    @if(session('cocheCreado'))
    <div id="cocheCreado" class="alert alert-success" style="position: relative; padding-right: 40px;">
        {{ session('cocheCreado') }}
        <button onclick="document.getElementById('cocheCreado').remove()"
            style="position:absolute;right:15px; background: none; border: none; font-weight: bold; font-size: 17px; cursor: pointer;">
            ×
        </button>
    </div>
    @endif
    @if(session('cocheActualizado'))
    <div id="cocheCreado" class="alert alert-success" style="position: relative; padding-right: 40px;">
        {{ session('cocheActualizado') }}
        <button onclick="document.getElementById('cocheCreado').remove()"
            style="position:absolute;right:15px; background: none; border: none; font-weight: bold; font-size: 17px; cursor: pointer;">
            ×
        </button>
    </div>
    @endif
    @if(session('cocheBorrado'))
    <div id="cocheCreado" class="alert alert-success" style="position: relative; padding-right: 40px;">
        {{ session('cocheBorrado') }}
        <button onclick="document.getElementById('cocheCreado').remove()"
            style="position:absolute;right:15px; background: none; border: none; font-weight: bold; font-size: 17px; cursor: pointer;">
            ×
        </button>
    </div>
    @endif
    <div class="card w-100">

        <div class="card-header">{{ __('Hoteles') }}</div>
        <div class="card-body d-flex flex-column gap-2 table-responsive">
            <form method="GET" action="{{ route('admin.crearhotel') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Crear hotel
                </button>
            </form>
        </div>
    </div>



    <form method="POST" action="{{ route('admin.logoutAdmin') }}">
        @csrf
        <button type="submit" class="btn btn-danger">
            Cerrar sesión
        </button>
    </form>
</div>

@endsection