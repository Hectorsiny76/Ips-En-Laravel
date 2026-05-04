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
        Schema::create('cajatipo_establecimiento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('establecimiento_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('cajatipo_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('numcaja');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autocobrotiendas');
    }
};
