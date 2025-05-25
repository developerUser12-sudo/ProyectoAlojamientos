<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $fillable = ['hotel_id', 'tipo_habitacion', 'precio_noche', 'capacidad', 'disponibles', 'imagenes'];
}
