<?php

namespace App\Http\Controllers;

use App\Models\CocheReservado;
use Illuminate\Http\Request;

class ReservadosController extends Controller
{
     public function index(){
        $coches=(new CocheReservadoController)->getCochesById();
        return view('reservas',compact('coches'));
    }
}

