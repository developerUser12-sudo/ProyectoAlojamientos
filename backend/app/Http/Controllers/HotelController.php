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
}
