<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(){
        $coches=(new CocheController)->getCochesPaginados();
        $hoteles=(new HotelController)->getHotelesPaginados();
        return view('admin.paneladministracion',compact('coches','hoteles'));
    }
}
