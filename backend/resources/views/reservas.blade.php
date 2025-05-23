@extends('layouts.app')

@section('content')
<div class="container border rounded border-secondary">
    @foreach ($coches as $coche)
    <table class="table">
        <tr>
            <th></th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Precio</th>

        </tr>
        <tr>
            <td><a href="{{ config('app.frontend_url') }}/detalle/{{ $coche->id }}"><img src="{{ $coche->imagen }}" alt="" class="img-fluid w-50" style="min-width:130px;"></a></td>
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
                <p> {{ $coche->precio }}</p>
            </td>

            <td>
                <div class="ms-auto d-flex flex-md-row flex-column gap-2">
                    <form action="{{ route('cancelarreserva', $coche->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="btn btn-danger" value="Cancelar reserva">
                    </form>
                </div>
            </td>

        </tr>
    </table>
    @endforeach
    @if (count($coches) == 0)
    <p>Todavía no has reservado nada, ¿a qué esperas?</p>
    @endif


</div>
@endsection