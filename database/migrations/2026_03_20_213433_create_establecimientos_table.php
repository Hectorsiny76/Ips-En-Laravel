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
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('numero');
            $table->string('nombre');
            $table->unsignedInteger('cajas_tpvs');
            $table->string('idred');

            $table->foreignId('campogerente_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tidelprograma_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tiendaformato_id')->nullable()->constrained()->nullOnDelete();

            $table->string('centrodecostos')->nullable();
            $table->string('tel')->nullable();
            $table->string('correo')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establecimientos');
    }
};
