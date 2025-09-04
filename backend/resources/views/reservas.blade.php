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

                            @if (\Carbon\Carbon::now()->diffInDays($cochesUsuario[$i]->fecha_salida, false) < 1)

                                <input type="submit" class="btn btn-danger" value="Cancelar reserva" disabled>
                                @else
                                <input type="button" class="btn btn-danger" value="Cancelar reserva" data-toggle="modal" data-target="#confirmacionCoche-{{ $cochesUsuario[$i]->id }}">
                                @endif
                        </td>
                        <div class="modal fade" id="confirmacionCoche-{{ $cochesUsuario[$i]->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmacionLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmacionLabel">Confirmación</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Quieres cancelar la reserva?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                                        <form action="{{ route('cancelarreservacoche', $cochesUsuario[$i]->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Cancelar reserva</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <th>Habitacion</th>
                        <th>Direccion</th>
                        <th>Precio total</th>
                        <th>Servicio de comida</th>
                        <th>Dia de entrada</th>
                        <th>Dia de salida</th>
                    </tr>
                    @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($reserva->created_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ config('app.frontend_url') }}/detalle-hotel/{{ $reserva->hotel->id }}"
                                class="text-decoration-none text-black">
                                <img src="{{ $reserva->hotel->imagenes[0] }}"
                                    alt="Imagen hotel {{ $reserva->hotel->nombre }}" class="img-fluid w-100"
                                    style="max-width:300px;min-width:100px"><br>
                                <b>{{ $reserva->hotel->nombre }}</b>
                            </a>
                        </td>
                        <td>{{ $reserva->habitacion->tipo_habitacion }}</td>
                        <td>{{ $reserva->hotel->direccion }}, {{ $reserva->hotel->localizacion }}</td>
                        <td>{{ $reserva->pagado }}</td>
                        <td>{{ $reserva->comida }}</td>
                        <td>{{ \Carbon\Carbon::parse($reserva->fecha_entrada)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reserva->fecha_salida)->format('d/m/Y') }}</td>
                        <td>
                            @if (\Carbon\Carbon::now()->diffInDays($reserva->fecha_entrada, false) < 1)
                                <input type="button" class="btn btn-danger" value="Cancelar reserva" disabled>
                                @else
                                <input type="button" class="btn btn-danger" value="Cancelar reserva" data-toggle="modal" data-target="#confirmacionHotel-{{ $reserva->id }}">
                                @endif

                        </td>
                        <div class="modal fade" id="confirmacionHotel-{{ $reserva->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmacionLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmacionLabel">Confirmación</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Quieres cancelar la reserva?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                                        <form action="{{ route('cancelarreservahotel', $reserva->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Cancelar reserva</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
    @if (count($coches) == 0 && count($reservas) == 0)
    <p>Todavía no has reservado nada, ¿a qué esperas?</p>
    @endif
</div>
@endsection