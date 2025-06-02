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

            if ($request->has('origen') && !empty($request->origen)) {
                $query->whereRaw('LOWER(TRIM(origen)) LIKE ?', ['%' . strtolower(trim($request->origen)) . '%']);
            }
            if ($request->has('destino') && !empty($request->destino)) {
                $query->whereRaw('LOWER(TRIM(destino)) LIKE ?', ['%' . strtolower(trim($request->destino)) . '%']);
            }

            if ($request->has('marca') && !empty($request->marca)) {
                $query->whereRaw('LOWER(TRIM(marca)) like ?', ['%' . strtolower(trim($request->marca)) . '%']);
            }
            if ($request->has('modelo') && !empty($request->modelo)) {
                $query->whereRaw('LOWER(TRIM(modelo)) like ?', ['%' . strtolower(trim($request->modelo)) . '%']);
            }
            if ($request->has('precio_min') && !empty($request->precio_min)) {
                $query->whereBetween('precio', [$request->precio_min, $request->precio_max]);
            }

        }

        $coches = $query->get();

        return response()->json($coches);
    }

    public function index()
    {
        return Coche::all();
    }

    public function getCochesPaginados()
    {
        return Coche::paginate(3, ['*'], 'coches_paginados');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio_original' => 'required|numeric',
            'total' => 'required|numeric',
            'descuento' => 'required|numeric',
        ]);
        if ($validated['descuento'] > 0) {
            $cantidad = ($validated['precio_original'] * $validated['descuento']) / 100;
            $precio_final = $validated['precio_original'] - $cantidad;
        } else {
            $precio_final = $validated['precio_original'];

        }
        $validated['precio'] = $precio_final;
        $validated['disponibles'] = $validated['total'];
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
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio_original' => 'required|numeric',
            'total' => 'required|numeric',
            'descuento' => 'required|numeric',
        ]);
        if ($validated['descuento'] > 0) {
            $cantidad = ($validated['precio_original'] * $validated['descuento']) / 100;
            $precio_final = $validated['precio_original'] - $cantidad;
        } else {
            $precio_final = $validated['precio_original'];

        }
        if ($validated['total'] > $coche->total) {
            $coche->disponibles += $validated['total'] - $coche->total;
        } else {
            $coche->disponibles -= $coche->total - $validated['total'];

        }
        $validated['precio'] = $precio_final;
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
