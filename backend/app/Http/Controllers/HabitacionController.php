<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function filtrar(Request $request)
    {
        $query = Habitacion::query();

        if ($request->has('hotel_id')) {
            $query->where('hotel_id', 'like', $request->hotel_id);
        }
       

        $habitaciones = $query->get();

        return response()->json($habitaciones);
    }
    public function index()
    {
        $habitaciones = Habitacion::all();
        foreach ($habitaciones as $habitacion) {
            $habitacion->imagenes = json_decode($habitacion->imagenes);


        }
        return $habitaciones;
    }
    public function getHabitacionesPaginadas($id)
    {

        $habitaciones = Habitacion::where('hotel_id', $id)->simplePaginate(3);
        $hotel = Hotel::find($id);
        foreach ($habitaciones as $habitacion) {

            $habitacion->imagenes = json_decode($habitacion->imagenes);


        }
        return view('admin.habitacioneshotel', compact('habitaciones', 'hotel'));
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
        $validated['hotel_id'] = $request->input('hotel_id');
        if ($validated['descuento'] > 0) {
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
    public function edit($id)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->imagenes = json_decode($habitacion->imagenes);
        return view('admin.actualizarhabitacion', compact('habitacion'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tipo_habitacion' => 'required|string|max:255',
            'precio_original_noche' => 'required|numeric',
            'capacidad' => 'required|numeric',
            'imagenes' => 'required|array|max:10',
            'imagenes.*' => 'string|max:255',
            'total' => 'required|numeric',
            'descuento' => 'required|numeric',
        ]);
        $validated['imagenes'] = json_encode($validated['imagenes']);
        if ($validated['descuento'] > 0) {
            $cantidad = ($validated['precio_original_noche'] * $validated['descuento']) / 100;
            $precio_final = $validated['precio_original_noche'] - $cantidad;
        } else {
            $precio_final = $validated['precio_original_noche'];

        }
        $validated['precio_noche'] = $precio_final;
        $habitacion = Habitacion::find($id);
        if ($validated['total']>$habitacion->total) {
            $habitacion->disponibles+=$validated['total']-$habitacion->total;
        }else {
            $habitacion->disponibles-=$habitacion->total-$validated['total'];
            
        }
        $habitacion->tipo_habitacion = $validated['tipo_habitacion'];
        $habitacion->precio_noche = $validated['precio_noche'];
        $habitacion->precio_original_noche = $validated['precio_original_noche'];
        $habitacion->capacidad = $validated['capacidad'];
        $habitacion->descuento = $validated['descuento'];
        $habitacion->total = $validated['total'];
        $habitacion->imagenes = $validated['imagenes'];
        $habitacion->save();

        return redirect()->route('admin.habitacioneshotel',$habitacion->hotel_id)->with('habitacionActualizada', 'Habitacion actualizada correctamente');
    }
     public function destroy($id)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->delete();

        return redirect()->route('admin.habitacioneshotel',$habitacion->hotel_id)->with('habitacionBorrada', 'Habitacion borrada correctamente');
    }
}
