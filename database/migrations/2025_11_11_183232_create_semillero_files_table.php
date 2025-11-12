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
        Schema::create('semillero_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semillero_id')->constrained('semilleros')->onDelete('cascade');
            $table->string('nombre_original'); // nombre del archivo subido
            $table->string('ruta');            // ruta dentro de storage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semillero_files');
    }
};
