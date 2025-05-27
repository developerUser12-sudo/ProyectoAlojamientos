<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        return Hotel::all();
    }
    public function getHotelesPaginados()
    {
        return Hotel::simplePaginate(3);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'localizacion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estrellas' => 'required|integer|min:0|max:5',
            'servicios' => 'required|array|max:10',
            'servicios.*' => 'string|max:255',
            'imagenes' => 'required|array|max:10',
            'imagenes.*' => 'string|max:255',
            'capacidad' => 'required|integer|min:1',
            'hora_apertura' => 'required|date_format:H:i',
            'hora_cierre' => 'required|date_format:H:i',
        ]);
        $validated['servicios'] = json_encode($validated['servicios']);
        $validated['imagenes'] = json_encode($validated['imagenes']);

        Hotel::create($validated);

        return redirect()->route('admin.paneladministracion')->with('hotelCreado', 'Hotel creado correctamente');
    }
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        $hotel->servicios = json_decode($hotel->servicios);
        $hotel->imagenes = json_decode($hotel->imagenes);
        return view('admin.actualizarhotel', compact('hotel'));
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'localizacion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estrellas' => 'required|integer|min:0|max:5',
            'servicios' => 'required|array|max:10',
            'servicios.*' => 'string|max:255',
            'imagenes' => 'required|array|max:10',
            'imagenes.*' => 'string|max:255',
            'capacidad' => 'required|integer|min:1',
            'hora_apertura' => 'required|date_format:H:i:s',
            'hora_cierre' => 'required|date_format:H:i:s',
        ]);

        $validated['servicios'] = json_encode($validated['servicios']);
        $validated['imagenes'] = json_encode($validated['imagenes']);


        $hotel = Hotel::find($id);
        $hotel->nombre = $validated['nombre'];
        $hotel->localizacion = $validated['localizacion'];
        $hotel->direccion = $validated['direccion'];
        $hotel->estrellas = $validated['estrellas'];
        $hotel->capacidad = $validated['capacidad'];
        $hotel->hora_apertura = $validated['hora_apertura'];
        $hotel->hora_cierre = $validated['hora_cierre'];
        $hotel->servicios = $validated['servicios'];
        $hotel->imagenes = $validated['imagenes'];
        $hotel->save();


        return redirect()->route('admin.paneladministracion')->with('hotelActualizado', 'Hotel actualizado correctamente');
    }
    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        $hotel->delete();

        return redirect()->route('admin.paneladministracion')->with('hotelBorrado', 'Hotel borrado correctamente');
    }

}
