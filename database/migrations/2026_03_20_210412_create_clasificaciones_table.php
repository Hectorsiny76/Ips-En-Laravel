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
        Schema::create('clasificaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('categoria_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subcategoria_id')->constrained()->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained()->cascadeOnDelete();
            $table->foreignId('microservicio_id')->constrained()->cascadeOnDelete();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificaciones');
    }
};
