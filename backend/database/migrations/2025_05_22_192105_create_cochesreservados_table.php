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
         Schema::create('cochesreservados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_coche')->constrained('coches');
            $table->foreignId('id_usuario')->constrained('users');
            $table->dateTime('fecha_recogida');
            $table->dateTime('fecha_devolucion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cochesreservados');
    }
};
