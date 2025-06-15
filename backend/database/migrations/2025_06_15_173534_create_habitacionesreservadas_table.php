<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('habitacionesreservadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade');
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->string('comida')->nullable();
            $table->decimal('pagado', 10, 2);
            $table->string('tipo_pago');
             $table->string('codigo_reserva')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacionesreservadas');
    }
};
