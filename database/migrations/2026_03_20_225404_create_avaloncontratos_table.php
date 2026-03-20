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
        Schema::create('avaloncontratos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero')->unique();
            $table->foreignId('estatus_id')->constrained()->cascadeOnDelete();
            $table->foreignId('establecimiento_id')->constrained()->cascadeOnDelete();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaloncontratos');
    }
};
