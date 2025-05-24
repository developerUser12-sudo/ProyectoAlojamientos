@extends('layouts.app')

@section('content')
    <div class="container">

       <div class="table-responsive">
             <table class="table bg-white border rounded border-secondary">
            <tr>
                <th></th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Precio</th>
                <th>Fecha seleccionada</th>
            </tr>
            @for ($i = 0; $i < count($coches); $i++)
                <tr>
                    <td>
                        <a href="{{ config('app.frontend_url') }}/detalle/{{ $coches[$i]->id }}"
                            class="text-decoration-none text-black">
                            <img src="{{ $coches[$i]->imagen }}" alt="Imagen coche" class="img-fluid w-50"
                                style="max-width:300px;min-width:100px"><br>{{ $coches[$i]->marca }} {{ $coches[$i]->modelo }}
                        </a>
                    </td>
                    <td>{{ $coches[$i]->origen }}</td>
                    <td>{{ $coches[$i]->destino }}</td>
                    <td>{{ $cochesUsuario[$i]->precio }}</td>
                    <td>{{ $cochesUsuario[$i]->fecha_recogida }} --- {{ $cochesUsuario[$i]->fecha_devolucion }}</td>
                    <td>
                        <form action="{{ route('cancelarreserva', $cochesUsuario[$i]->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if (\Carbon\Carbon::now()->diffInMinutes($cochesUsuario[$i]->fecha_recogida, false) < 180)

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