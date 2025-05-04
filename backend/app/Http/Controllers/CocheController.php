<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coche;
class CocheController extends Controller
{
    public function index()
    {   
        return Coche::all();
    }

    // Crear un nuevo coche
    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255', // o puede ser un archivo
            'precio' => 'required|numeric',
        ]);

        // Crear coche
        Coche::create($validated);

        return redirect()->route('admin.crearcoche')->with('success', 'Coche creado correctamente.');
    }

    // Mostrar un coche específico
    public function show(Coche $coche)
    {
        return $coche;
    }

    // Actualizar un coche específico
    public function update(Request $request, Coche $coche)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);
        $coche->update($request->all());

        return response()->json($coche);
    }

    // Eliminar un coche
    public function destroy(Coche $coche)
    {
        $coche->delete();

        return response()->json(null, 204);
    }
}
