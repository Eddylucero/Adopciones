<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cirugias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->date('fecha_cirugia');
            $table->string('duracion')->nullable();
            $table->text('motivo')->nullable();
            $table->string('estado')->default('Programada');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cirugias');
    }
};
