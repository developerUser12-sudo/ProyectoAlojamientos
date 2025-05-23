@extends('layouts.app')

@section('content')
    <div class="container border rounded border-secondary">

        @for ($i = 0; $i < count($coches); $i++)
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Precio</th>
                        <th>Fecha seleccionada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="{{ config('app.frontend_url') }}/detalle/{{ $coches[$i]->id }}">
                                <img src="{{ $coches[$i]->imagen }}" alt="" class="img-fluid w-50" style="min-width:130px;">
                            </a>
                        </td>
                        <td>{{ $coches[$i]->origen }}</td>
                        <td>{{ $coches[$i]->destino }}</td>
                        <td>{{ $coches[$i]->marca }}</td>
                        <td>{{ $coches[$i]->modelo }}</td>
                        <td>{{ $cochesUsuario[$i]->precio }}</td>
                        <td>{{ $cochesUsuario[$i]->fecha_recogida }} --- {{ $cochesUsuario[$i]->fecha_devolucion }}</td>
                        <td>
                            <form action="{{ route('cancelarreserva', $cochesUsuario[$i]->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if (\Carbon\Carbon::now()->diffInMinutes($cochesUsuario[$i]->fecha_recogida,false)<120)
                                
                                <input type="submit" class="btn btn-danger" value="Cancelar reserva" disabled>
                                @else
                                <input type="submit" class="btn btn-danger" value="Cancelar reserva">
                                @endif
                            </form>
                        </td>
                    </tr>
        @endfor
            </tbody>
        </table>
        @if (count($coches) == 0)
            <p>Todavía no has reservado nada, ¿a qué esperas?</p>
        @endif
    </div>
@endsection