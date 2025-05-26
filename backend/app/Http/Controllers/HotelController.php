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
    public function getCochesPaginados()
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
            'imagenes.*' => 'string|url|max:255',
            'capacidad' => 'required|integer|min:1',
            'hora_apertura' => 'required|date_format:H:i',
            'hora_cierre' => 'required|date_format:H:i',
        ]);
        $validated['servicios']=json_encode( $validated['servicios']);
        $validated['imagenes']=json_encode( $validated['imagenes']);
        
        Hotel::create($validated);

        return redirect()->route('admin.paneladministracion')->with('hotelCreado', 'Hotel creado correctamente');
    }

}
