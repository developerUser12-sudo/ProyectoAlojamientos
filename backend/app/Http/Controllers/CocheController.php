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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        Coche::create($validated);

        return redirect()->route('admin.paneladministracion');
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
            'precio' => 'required|numeric',
        ]);

        $coche->update($validated);

        return redirect()->route('admin.paneladministracion');
    }


    public function destroy($id)
    {
        $coche = Coche::find($id);
        $coche->delete();

        return redirect()->route('admin.paneladministracion');
    }
}
