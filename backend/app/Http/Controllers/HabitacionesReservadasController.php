<?php

namespace App\Http\Controllers;

use App\Mail\CancelaServicio;
use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\HabitacionesReservadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use \App\Mail\CorreoHabitacion;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
            'tipo_pago' => 'required|string',
        ]);

        $habitacion = Habitacion::find($validated['habitacion_id']);
        if ($habitacion) {
            $habitacion->disponibles -= 1;
            $habitacion->save();
        }
        $fechaEntrada = Carbon::parse($validated['fecha_entrada']);
        $fechaSalida = Carbon::parse($validated['fecha_salida']);
        $dias = $fechaSalida->diffInDays($fechaEntrada, true);
        $validated['pagado'] = $habitacion->precio_noche * $dias;
        $validated['codigo_reserva'] = date('Ymd') . '-' . strtoupper(Str::random(4));

        $hotel = Hotel::find($habitacion->hotel_id);
        HabitacionesReservadas::create($validated);
        $usuario = User::find($validated['id_usuario']);
        if ($usuario) {

            Mail::to($usuario->email)->send(new CorreoHabitacion($usuario, $habitacion, $hotel, $validated['codigo_reserva']));
        }


    }
    public function destroy($id)
    {
        $habitacion = HabitacionesReservadas::find($id);

        $encontrarHabitacion = Habitacion::find($habitacion->habitacion_id);
        if ($encontrarHabitacion) {
            $encontrarHabitacion->disponibles+=1;
            $encontrarHabitacion->save();
        }
        $hotel = Hotel::find($encontrarHabitacion->hotel_id);

        Mail::to(Auth::user()->email)->send(new CancelaServicio(Auth::user(), $encontrarHabitacion, $hotel));
        $habitacion->delete();

        return redirect()->route('reservas');
    }
}
