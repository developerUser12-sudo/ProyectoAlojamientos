@extends('layouts.app')

@section('content')
<div class="container d-flex flex-row">

    <div class="card">
   
        <div class="card-header">{{ __('Coches') }}</div>
    
        <div class="card-body d-flex flex-column gap-2">
    
            <form method="GET" action="{{ route('admin.crearcoche') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Crear coche
                </button>
            </form>
            <br>

                @foreach ($coches as $coche)
                <div class="border border-secondary rounded d-flex flex-row flex-wrap w-auto gap-3">
                <img src="{{ $coche->imagen }}" alt="">
                <p><b>Origen:</b> {{ $coche->origen }}</p>
                <p><b>Destino:</b> {{ $coche->destino }}</p>
                <p><b>Marca:</b> {{ $coche->marca }}</p>
                <p><b>Modelo:</b> {{ $coche->modelo }}</p>
                <p><b>Precio:</b> {{ $coche->precio }}</p>

                </div>
                @endforeach
            
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