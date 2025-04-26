@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('admin.logoutAdmin') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        Cerrar sesión
    </button>
</form>
<form method="GET" action="{{ route('admin.crearcoche') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        Crear coche
    </button>
</form>

