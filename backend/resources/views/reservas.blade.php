@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs" id="reservaTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="coches-tab" data-bs-toggle="tab" data-bs-target="#coches" type="button"
                    role="tab" aria-controls="coches" aria-selected="true">
                    Coches
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hoteles-tab" data-bs-toggle="tab" data-bs-target="#hoteles" type="button"
                    role="tab" aria-controls="hoteles" aria-selected="false">
                    Hoteles
                </button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="reservaTabsContent">
            <div class="tab-pane fade show active" id="coches" role="tabpanel">
                <div class="table-responsive">
                    <table class="table border rounded border-secondary">
                        <tr>
                            <th>Fecha de reserva</th>
                            <th>Coche</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Precio</th>
                            <th>Fecha seleccionada</th>
                        </tr>
                        @for ($i = 0; $i < count($coches); $i++)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($cochesUsuario[$i]->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ config('app.frontend_url') }}/detalle-coche/{{ $coches[$i]->id }}"
                                        class="text-decoration-none text-black">
                                        <img src="{{ $coches[$i]->imagen }}"
                                            alt="Imagen coche {{ $coches[$i]->marca }} {{ $coches[$i]->modelo }}"
                                            class="img-fluid w-50"
                                            style="max-width:300px;min-width:100px"><br><b>{{ $coches[$i]->marca }}
                                            {{ $coches[$i]->modelo }}</b>
                                    </a>
                                </td>
                                <td>{{ $coches[$i]->origen }}</td>
                                <td>{{ $coches[$i]->destino }}</td>
                                <td>{{ $cochesUsuario[$i]->pagado }}</td>
                                <td>
                                   
                                    {{ \Carbon\Carbon::parse($cochesUsuario[$i]->fecha_salida)->format('d/m/Y') }}

                                </td>

                                <td>
                                    <form action="{{ route('cancelarreserva', $cochesUsuario[$i]->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @if (\Carbon\Carbon::now()->diffInDays($cochesUsuario[$i]->fecha_salida, false) < 1)

                                            <input type="submit" class="btn btn-danger" value="Cancelar reserva" disabled>
                                        @else
                                            <input type="submit" class="btn btn-danger" value="Cancelar reserva">
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="hoteles" role="tabpanel">
                <div class="table-responsive">
                    <table class="table border rounded border-secondary">
                        <tr>
                            <th>Fecha de reserva</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Precio por noche</th>
                            <th>Servicio de comida</th>
                            <th>Dia de entrada</th>
                            <th>Dia de salida</th>
                        </tr>
                        @for ($i = 0; $i < count($hoteles); $i++)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($habitacionesUsuario[$i]->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ config('app.frontend_url') }}/detalle-hotel/{{ $hoteles[$i]->id }}"
                                        class="text-decoration-none text-black">
                                        <img src="{{ $hoteles[$i]->imagenes[0] }}"
                                            alt="Imagen hotel {{ $hoteles[$i]->nombre }}"
                                            class="img-fluid w-100"
                                            style="max-width:300px;min-width:100px"><br><b>{{ $hoteles[$i]->nombre }}</b>
                                    </a>
                                </td>
                                <td>{{ $hoteles[$i]->direccion }}, {{ $hoteles[$i]->localizacion }}</td>
                                <td>{{ $habitacionesUsuario[$i]->pagado }}</td>
                                <td>{{ $habitacionesUsuario[$i]->comida }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($habitacionesUsuario[$i]->fecha_entrada)->format('d/m/Y') }}

                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($habitacionesUsuario[$i]->fecha_salida)->format('d/m/Y') }}

                                </td>

                                <td>
                                    <form action="{{ route('cancelarreserva', $cochesUsuario[$i]->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @if (\Carbon\Carbon::now()->diffInDays($cochesUsuario[$i]->fecha_salida, false) < 1)

                                            <input type="submit" class="btn btn-danger" value="Cancelar reserva" disabled>
                                        @else
                                            <input type="submit" class="btn btn-danger" value="Cancelar reserva">
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
            </div>
        </div>
        @if (count($coches) == 0)
            <p>Todavía no has reservado nada, ¿a qué esperas?</p>
        @endif
    </div>
@endsection