<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocheReservado extends Model
{
    use HasFactory;
    protected $table = 'cochesreservados';
    protected $fillable = ['id_coche', 'id_usuario', 'fecha_salida','pagado','codigo_reserva'];
}