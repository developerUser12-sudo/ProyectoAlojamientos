@extends('layouts.app')

@section('content')
    <div class="container-xxl d-flex flex-column gap-3">
        <div class="card w-100">

            <div class="card-header">{{ __('Habitaciones del hotel :nombre', ['nombre' => $hotel->nombre]) }}</div>

            <div class="card-body d-flex flex-column gap-2 table-responsive">

                <form method="GET" action="{{ route('admin.crearhabitacion', $hotel->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Crear habitacion
                    </button>
                </form>
                <br>
                <table class="table">
                    <tr>
                        <th>Imagen y precio</th>
                        <th>Tipo habitacion</th>
                        <th>Capacidad</th>
                        <th>Total</th>
                        <th>Disponibles</th>
                        <th>Precio sin descuento</th>
                        <th>Descuento</th>
                    </tr>
                    @foreach ($habitaciones as $habitacion)
                        <tr>
                            <td>
                                <div id="carouselExampleIndicators" class="carousel slide w-100 m-auto" data-ride="carousel">

                                    <div class="carousel-inner">
                                        @for ($i = 0; $i < count($habitacion->imagenes); $i++)
                                            @if ($i == 0)

                                                <div class="carousel-item active">
                                                    <a href="{{ $habitacion->imagenes[$i] }}" data-lightbox="gallery">

                                                        <img class="d-block w-100" src="{{ $habitacion->imagenes[$i] }}"
                                                            alt="{{  $habitacion->tipo_habitacion }} slide">
                                                    </a>
                                                </div>
                                            @else

                                                <div class="carousel-item ">
                                                    <a href="{{ $habitacion->imagenes[$i] }}" data-lightbox="gallery">

                                                        <img class="d-block w-100" src="{{ $habitacion->imagenes[$i] }}"
                                                            alt="{{  $habitacion->tipo_habitacion }} slide">
                                                    </a>
                                                </div>
                                            @endif

                                        @endfor

                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </a>
                                </div><br><b class="text-center">
                                    {{ $habitacion->precio_noche }}€</b>
                            </td>
                            <td>
                                <p> {{ $habitacion->tipo_habitacion }}</p>
                            </td>
                            <td>
                                <p> {{ $habitacion->capacidad }}</p>
                            </td>
                            <td>
                                <p> {{ $habitacion->total }}</p>
                            </td>
                            <td>
                                <p> {{ $habitacion->disponibles }}</p>
                            </td>
                            <td>
                                <p> {{ $habitacion->precio_original_noche }}</p>
                            </td>
                            <td>
                                <p> {{ $habitacion->descuento }}</p>
                            </td>
                            <td>
                                <div class="ms-auto d-flex flex-md-row flex-column gap-2">
                                    <form action="{{ route('admin.actualizarhabitacion', $habitacion->id) }}">
                                        <input type="submit" class="btn btn-warning" value="Editar">
                                    </form>
                                    <form action="{{ route('admin.deletehabitacion', $habitacion->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <input type="submit" class="btn btn-danger" value="Eliminar">
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </table>
                <div class="paginate">
                    {{ $habitaciones->links() }}

                </div>

            </div>
        </div>
    </div>
@endsection