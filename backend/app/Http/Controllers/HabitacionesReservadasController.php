<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\HabitacionesReservadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use \App\Mail\CorreoHabitacion;
class HabitacionesReservadasController extends Controller
{
    public function index()
    {
        return HabitacionesReservadas::all();
    }


    public function getHabitacionesById()
    {
        $reservas = HabitacionesReservadas::where('id_usuario', Auth::id())->get();

        foreach ($reservas as $reserva) {
            $habitacion = Habitacion::find($reserva->habitacion_id);
            $hotel = Hotel::find($habitacion->hotel_id);
            $hotel->imagenes = json_decode($hotel->imagenes);
            $reserva->habitacion = $habitacion;
            $reserva->hotel = $hotel;
        }
        return $reservas;

    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'habitacion_id' => 'required|integer',
            'id_usuario' => 'required|integer',
            'fecha_salida' => 'required|date',
            'fecha_entrada' => 'required|date',
            'comida' => 'required|string',
        ]);

        $habitacion = Habitacion::find($validated['habitacion_id']);
        if ($habitacion) {
            $habitacion->disponibles -= 1;
            $habitacion->save();
        }
        $validated['pagado'] = $habitacion->precio_noche;
        $hotel = Hotel::find($habitacion->hotel_id);
        HabitacionesReservadas::create($validated);
        $usuario = User::find($validated['id_usuario']);
        if ($usuario) {

            Mail::to($usuario->email)->send(new CorreoHabitacion($usuario, $habitacion, $hotel));
        }


    }
    public function destroy($id)
    {
        $coche = HabitacionesReservadas::where('id', $id);
        $coche->delete();
        return redirect()->route('reservas');
    }
}
