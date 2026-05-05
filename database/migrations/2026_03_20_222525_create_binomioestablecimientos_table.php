<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('binomioestablecimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('tienda_id')->constrained('establecimientos');
            $table->foreignId('estacion_id')->constrained('establecimientos');
            $table->softDeletes();
        });
        //aplicar barrera en caso de que sea el servidor MYSQL
        if(\Illuminate\Support\Facades\DB::getDriverName()!=='sqlite'){
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE binomioestablecimientos ADD CONSTRAINT revisar_diferentes_establecimientos CHECK (tienda_id!=estacion_id)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //quitar barrera en caso de que sea el servidor MYSQL
        if(\Illuminate\Support\Facades\DB::getDriverName()!=='sqlite'){
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE binomioestablecimientos DROP CONSTRAINT revisar_diferentes_establecimientos');
        }

        Schema::dropIfExists('binomioestablecimientos');
    }
};
