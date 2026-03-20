<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{

    protected $table = 'servicios';

    protected $fillable = ['nombre'];

    use HasFactory;

    use SoftDeletes;

    public function clasificaciones(){
        return $this->hasMany(Clasificacione::class);
    }

    protected static function booted(){
        static::deleting(function($servicio){
            $servicio->clasificaciones->each(function($clasificacion){
                $clasificacion->delete();
            });
        });
    }
}
