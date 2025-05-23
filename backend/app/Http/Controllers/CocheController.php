<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coche;
class CocheController extends Controller
{
    public function filtrar(Request $request)
    {
        $query = Coche::query();

        if ($request->has('id')) {
            $query->where('id', 'like', $request->id);
        } else {

            $query->where('origen', 'like', '%' . $request->origen . '%');
            $query->where('destino', 'like', '%' . $request->destino . '%');
            if ($request->has('marca') && !empty($request->marca)) {
                $query->whereRaw('LOWER(TRIM(origen)) like ?', ['%' . strtolower(trim($request->origen)) . '%']);
            }
            if ($request->has('modelo') && !empty($request->modelo)) {
                $query->whereRaw('LOWER(TRIM(destino)) like ?', ['%' . strtolower(trim($request->destino)) . '%']);
            }
            if ($request->has('precio_min') && !empty($request->precio_min)) {
                $query->where('precio', '>=', $request->precio_min);
            }
            if ($request->has('precio_max') && !empty($request->precio_max)) {
                $query->where('precio', '<=', $request->precio_max);
            }

        }

        $coches = $query->get();

        return response()->json($coches);
    }
    public function index()
    {
        return Coche::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'total' => 'required|numeric',
            'descuento' => 'required|numeric',

        ]);
        $validated['disponibles'] = $validated['total'];
        if ($validated['descuento'] > 0) {
            $cantidad = ($validated['precio'] * $validated['descuento']) / 100;
            $validated['precio'] -= $cantidad;
        }
        Coche::create($validated);

        return redirect()->route('admin.paneladministracion')->with('cocheCreado', 'Coche creado correctamente');
    }

    public function edit($id)
    {
        $coche = Coche::find($id);
        return view('admin.actualizarcoche', compact('coche'));
    }



    public function update(Request $request, $id)
    {
        $coche = Coche::find($id);
        $descuento = $coche->descuento;
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'total' => 'required|numeric',
            'descuento' => 'required|numeric',
        ]);
        if ($validated['descuento'] > 0) {
            $cantidad = ($validated['precio'] * $validated['descuento']) / 100;
            $validated['precio'] -= $cantidad;
        } else {
            $validated['precio'] = $validated['precio'] / (1 - $descuento / 100);

        }
        $coche->update($validated);

        return redirect()->route('admin.paneladministracion')->with('cocheActualizado', 'Coche actualizado correctamente');
    }


    public function destroy($id)
    {
        $coche = Coche::find($id);
        $coche->delete();

        return redirect()->route('admin.paneladministracion')->with('cocheBorrado', 'Coche borrado correctamente');
    }
}
