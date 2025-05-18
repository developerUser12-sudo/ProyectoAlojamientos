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
         Schema::create('coches', function (Blueprint $table) {
            $table->id();
            $table->string('origen');
            $table->string('destino');
            $table->string('marca');
            $table->string('modelo');
            $table->string('imagen');
            $table->decimal('precio', 10, 2);
            $table->integer('disponibles');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coches');
    }
};
