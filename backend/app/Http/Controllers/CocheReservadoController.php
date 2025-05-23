<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CocheReservado;
use App\Models\Coche;
use Illuminate\Support\Facades\Auth;
class CocheReservadoController extends Controller
{
    public function index()
    {
        return CocheReservado::all();
    }
    public function getCochesById(){
        $cochesUsuario=CocheReservado::where('id_usuario',Auth::id())->get();
        $idCoche=$cochesUsuario->pluck('id_coche')->toArray();
        $coches=Coche::where('id',$idCoche)->get();
        return $coches;
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_coche' => 'required|integer',
            'id_usuario' => 'required|integer',
            'fecha_recogida' => 'required|date',
            'fecha_devolucion' => 'required|date'
        ]);
        $coche=Coche::find($validated['id_coche']);
        if ($coche) {
            $coche->disponibles-=1;
            $coche->save();
        }
        $reserva=CocheReservado::create($validated);
        return response()->json([
            'success' => true,
            'reserva' => $reserva
        ]);

    }
    public function destroy($id)
    {
        $coche = CocheReservado::where('id_coche',$id)->where('id_usuario',Auth::id());
        $coche->delete();
        return redirect()->route('reservas');
    }
}
