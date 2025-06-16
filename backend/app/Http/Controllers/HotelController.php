<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function filtrar(Request $request)
    {
        $queryHotel = Hotel::query();
        if ($request->has('id')) {
            $queryHotel->where('id', 'like', $request->id);
        } else {
            if ($request->has('nombre') && !empty($request->nombre)) {
                $queryHotel->whereRaw('LOWER(TRIM(nombre)) like ?', ['%' . strtolower(trim($request->nombre)) . '%']);
            }
            if ($request->has('localizacion') && !empty($request->localizacion)) {
                $queryHotel->whereRaw('LOWER(TRIM(localizacion)) like ?', ['%' . strtolower(trim($request->localizacion)) . '%']);
            }
            if ($request->has('estrellas') && !empty($request->estrellas)) {
                $queryHotel->whereRaw('estrellas like ?', ['%' . $request->estrellas . '%']);
            }
            if ($request->has('hora_apertura') && !empty($request->hora_apertura)) {
                $queryHotel->whereRaw('hora_apertura like ?', ['%' . $request->hora_apertura . '%']);
            }
            if ($request->has('hora_cierre') && !empty($request->hora_cierre)) {
                $queryHotel->whereRaw('hora_cierre like ?', ['%' . $request->hora_cierre . '%']);
            }
            if ($request->has('comidas') && !empty($request->hora_cierre)) {
                $comidasString = $request->input('comidas', '');
                $comidas = array_filter(array_map('trim', explode(',', $comidasString)));

                if (!empty($comidas)) {
                    $queryHotel->where(function ($query) use ($comidas) {
                        foreach ($comidas as $comida) {
                            $query->orWhereJsonContains('comidas', $comida);
                        }
                    });
                }
            }

            if ($request->has('precio_min') || $request->has('precio_max')) {
                $precioMin = $request->precio_min ?? 0;
                $precioMax = $request->precio_max ?? 1000;

                $queryHotel->whereHas('habitaciones', function ($query) use ($precioMin, $precioMax) {
                    $query->whereBetween('precio_noche', [$precioMin, $precioMax]);
                });
            }

        }
        $hoteles = $queryHotel->get();
        foreach ($hoteles as $hotel) {
            $hotel->imagenes = json_decode($hotel->imagenes);
        }
        return response()->json($hoteles);
    }
    public function index()
    {
        $hoteles = Hotel::all();
        foreach ($hoteles as $hotel) {
            $hotel->imagenes = json_decode($hotel->imagenes);
            $hotel->servicios = json_decode($hotel->servicios);
            $hotel->comidas = json_decode($hotel->comidas);

        }
        return $hoteles;
    }
    public function getHotelesPaginados()
    {
        $hoteles = Hotel::paginate(3, ['*'], 'hoteles_paginados');
        foreach ($hoteles as $hotel) {
            $hotel->imagenes = json_decode($hotel->imagenes);
            $hotel->servicios = json_decode($hotel->servicios);
            $hotel->comidas = json_decode($hotel->comidas);
        }
        return $hoteles;
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'localizacion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estrellas' => 'required|integer|min:1|max:5',
            'servicios' => 'required|array|max:10',
            'servicios.*' => 'string|max:255',
            'imagenes' => 'required|array|max:10',
            'imagenes.*' => 'string|max:255',
            'comidas' => 'required|array|max:10',
            'comidas.*' => 'string|max:255',
            'capacidad' => 'required|integer|min:1',
            'hora_apertura' => 'required|date_format:H:i',
            'hora_cierre' => 'required|date_format:H:i',
        ]);
        $validated['servicios'] = json_encode($validated['servicios']);
        $validated['imagenes'] = json_encode($validated['imagenes']);
        $validated['comidas'] = json_encode($validated['comidas']);

        Hotel::create($validated);

        return redirect()->route('admin.paneladministracion')->with('hotelCreado', 'Hotel creado correctamente');
    }
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        $hotel->servicios = json_decode($hotel->servicios);
        $hotel->imagenes = json_decode($hotel->imagenes);
        $hotel->comidas = json_decode($hotel->comidas);
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
            'comidas' => 'required|array|max:10',
            'comidas.*' => 'string|max:255',
            'capacidad' => 'required|integer|min:1',
            'hora_apertura' => 'required|date_format:H:i:s',
            'hora_cierre' => 'required|date_format:H:i:s',
        ]);

        $validated['servicios'] = json_encode($validated['servicios']);
        $validated['imagenes'] = json_encode($validated['imagenes']);
        $validated['comidas'] = json_encode($validated['comidas']);


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
        $hotel->comidas = $validated['comidas'];
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
