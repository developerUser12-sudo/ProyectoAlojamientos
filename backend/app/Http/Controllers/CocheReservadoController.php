<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CocheReservado;
class CocheReservadoController extends Controller
{
    public function index()
    {
        return CocheReservado::all();
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_coche' => 'required|integer',
            'id_usuario' => 'required|integer',
            'fecha_recogida' => 'required|date',
            'fecha_devolucion' => 'required|date',
        ]);

        $reserva=CocheReservado::create($validated);
        return response()->json([
            'success' => true,
            'reserva' => $reserva
        ]);

    }
}
