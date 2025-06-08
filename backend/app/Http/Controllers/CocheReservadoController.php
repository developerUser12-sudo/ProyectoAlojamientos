<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CocheReservado;
use App\Models\Coche;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \App\Mail\CorreoCoche;
class CocheReservadoController extends Controller
{
    public function index()
    {
        return CocheReservado::all();
    }


    public function getCochesById()
    {
        $cochesUsuario = CocheReservado::where('id_usuario', Auth::id())->get();
        $idCoche = $cochesUsuario->pluck('id_coche')->toArray();
        $coches = collect();
        for ($i = 0; $i < count($idCoche); $i++) {
            $coche = Coche::find($idCoche[$i]);
            if ($coche) {
                $coches->push($coche);
            }
        }
        return $coches;
    }

    public function getPrecioById()
    {
        $cochesUsuario = CocheReservado::where('id_usuario', Auth::id())->get();
        return $cochesUsuario;
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_coche' => 'required|integer',
            'id_usuario' => 'required|integer',
            'fecha_salida' => 'required|date',
            'tipo_pago' => 'required|string',
        ]);
        $coche = Coche::find($validated['id_coche']);
        if ($coche) {
            $coche->disponibles -= 1;
            $coche->save();
        }
        $validated['pagado']= $coche->precio;
        CocheReservado::create($validated);
        $usuario = User::find($validated['id_usuario']);
        if ($usuario) {
            
            Mail::to($usuario->email)->send(new CorreoCoche($usuario,$coche));
        }


    }
    public function destroy($id)
    {
        $coche = CocheReservado::where('id', $id);
        $coche->delete();
        return redirect()->route('reservas');
    }
}
