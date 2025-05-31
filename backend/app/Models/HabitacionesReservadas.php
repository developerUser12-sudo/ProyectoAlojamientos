<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitacionesReservadas extends Model
{
    use HasFactory;
    protected $table = 'habitacionesreservadas';
    protected $fillable = ['habitacion_id', 'id_usuario', 'fecha_entrada', 'fecha_salida', 'comida', 'pagado'];

}
