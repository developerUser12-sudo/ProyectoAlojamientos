<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;
    protected $fillable = ['origen', 'destino', 'marca', 'modelo', 'imagen', 'precio','disponibles','total','descuento'];
}
