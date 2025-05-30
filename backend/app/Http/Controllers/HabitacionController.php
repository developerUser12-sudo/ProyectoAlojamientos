<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        foreach ($habitaciones as $habitacion) {
            $habitacion->imagenes = json_decode($habitacion->imagenes);
           

        }
        return $habitaciones;
    }
    public function getHotelesPaginados()
    {
        $habitaciones = Habitacion::simplePaginate(3);
        foreach ($habitaciones as $habitacion) {
            $habitacion->imagenes = json_decode($habitacion->imagenes);
         
        }
        return $habitaciones;
    }
     public function create($id)
    {
        $hotel = Hotel::find($id);

        return view('admin.crearhabitacion', compact('hotel'));
    }
     public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_habitacion' => 'required|string|max:255',
            'precio_original_noche' => 'required|integer',
            'imagenes' => 'required|array|max:10',
            'imagenes.*' => 'string|max:255',
            'capacidad' => 'required|integer',
            'total' => 'required|integer',
            'descuento' => 'required|integer',
            'hotel_id' => 'required|integer|exists:hoteles,id',


        ]);
        $validated['hotel_id']= $request->input('hotel_id');
        if ($validated['descuento']>0) {
            $cantidad = ($validated['precio_original_noche'] * $validated['descuento']) / 100;
            $precio_final = $validated['precio_original_noche'] - $cantidad;
        } else {
            $precio_final = $validated['precio_original_noche'];

        }
        $validated['precio_noche'] = $precio_final;
        $validated['disponibles'] = $validated['total'];
        $validated['imagenes'] = json_encode($validated['imagenes']);

        Habitacion::create($validated);

        return redirect()->route('admin.paneladministracion')->with('habitacionCreada', 'Habitacion creada correctamente');
    }
}
