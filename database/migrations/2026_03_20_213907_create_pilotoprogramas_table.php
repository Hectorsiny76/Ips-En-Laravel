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
        Schema::create('pilotoprogramas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('titulo');
            $table->string('descripcion_corta');
            $table->text('descripcion_larga');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilotoprogramas');
    }
};
