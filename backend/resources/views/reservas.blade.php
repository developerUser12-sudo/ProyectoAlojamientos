@extends('layouts.app')

@section('content')
    <div class="container">

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
                                <img src="{{ $coches[$i]->imagen }}" alt="Imagen coche {{ $coches[$i]->marca }} {{ $coches[$i]->modelo }}" class="img-fluid w-50"
                                    style="max-width:300px;min-width:100px"><br><b>{{ $coches[$i]->marca }}
                                {{ $coches[$i]->modelo }}</b>
                            </a>
                        </td>
                        <td>{{ $coches[$i]->origen }}</td>
                        <td>{{ $coches[$i]->destino }}</td>
                        <td>{{ $coches[$i]->precio }}</td>
                        <td>
                            <span class="fw-bold">Día:</span>
                            {{ \Carbon\Carbon::parse($cochesUsuario[$i]->fecha_salida)->format('d/m/Y') }}<br>
                           
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
        @if (count($coches) == 0)
            <p>Todavía no has reservado nada, ¿a qué esperas?</p>
        @endif
    </div>
@endsection