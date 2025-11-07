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
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();

            // Relación con users
            $table->foreignId('user_id')
                  ->constrained()   // por defecto referencia a la tabla users
                  ->cascadeOnDelete();

            // Campos de información personal
            $table->enum('tipo_documento', [
                'Registro Civil',
                'Tarjeta de Identidad',
                'Cédula de Ciudadanía',
                'Cédula de Extranjería',
                'Pasaporte',
                'DNI'
            ]);

            $table->string('numero_documento');
            $table->string('genero');   // Ej: Masculino, Femenino, Otro
            $table->string('rh');       // Ej: O+, A-, etc.
            $table->string('eps');      // Nombre de la EPS
            $table->string('telefono');

            // Datos de formación
            $table->enum('tipo_programa', ['tecnico', 'tecnologo', 'complementaria'])->nullable();
            $table->string('programa_formacion')->nullable();
            $table->string('ficha_programa')->nullable();

            //Datos de semillero y proyecto
            $table->string('semillero_name')->nullable();
            $table->string('proyecto_titulo')->nullable();
            $table->text('proyecto_descripccion')->nullable();

            // Otros campos
            $table->string('apoyos')->nullable();          // Apoyos que recibe
            $table->string('formato_registro')->nullable(); // Ruta PDF en storage/app

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_users');
    }
};
