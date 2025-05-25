<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'localizacion', 'direccion', 'estrellas', 'servicios', 'imagenes','capacidad','fecha_apertura','fecha_cierre'];
}
