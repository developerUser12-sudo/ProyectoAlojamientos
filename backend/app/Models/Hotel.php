<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hoteles';
    protected $fillable = ['nombre', 'localizacion', 'direccion', 'estrellas', 'servicios', 'imagenes','comidas','capacidad','hora_apertura','hora_cierre'];
}
