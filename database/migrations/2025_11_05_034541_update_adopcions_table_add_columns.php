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
        Schema::table('adopcions', function (Blueprint $table) {
            // Campos nuevos
            $table->date('fecha_adopcion')->nullable()->after('id');
            $table->unsignedBigInteger('mascota_id')->nullable()->after('fecha_adopcion');
            $table->unsignedBigInteger('persona_id')->nullable()->after('mascota_id');
            $table->text('observaciones')->nullable()->after('persona_id');
            $table->string('lugar_adopcion')->nullable()->after('observaciones');
            $table->string('contrato')->nullable()->after('lugar_adopcion');

            // Claves foráneas (usamos addForeign por si las tablas aún no existían antes)
            $table->foreign('mascota_id')
                  ->references('id')->on('mascotas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('persona_id')
                  ->references('id')->on('personas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adopcions', function (Blueprint $table) {
            $table->dropForeign(['mascota_id']);
            $table->dropForeign(['persona_id']);
            $table->dropColumn([
                'fecha_adopcion',
                'mascota_id',
                'persona_id',
                'observaciones',
                'lugar_adopcion',
                'contrato',
            ]);
        });
    }
};
