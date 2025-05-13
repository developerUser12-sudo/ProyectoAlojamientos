@extends('layouts.app')

@section('content')
    <div class="container-xxl d-flex flex-row">

        <div class="card w-100">

            <div class="card-header">{{ __('Coches') }}</div>

            <div class="card-body d-flex flex-column gap-2">

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
                        <th>Precio</th>
                    </tr>
                    @foreach ($coches as $coche)
                        <tr>
                            <td><img src="{{ $coche->imagen }}" alt="" class="img-fluid w-50" style="min-width:130px;"><br><b
                                    class="text-center"> {{ $coche->precio }}</b></td>
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

            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.logoutAdmin') }}">
        @csrf
        <button type="submit" class="btn btn-danger">
            Cerrar sesión
        </button>
    </form>
@endsection