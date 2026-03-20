<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Microservicio extends Model
{

    protected $table = 'microservicios';

    protected $fillable = ['nombre'];

    use HasFactory;

    use SoftDeletes;

    public function clasificaciones(){
        return $this->hasMany(Clasificacione::class);
    }

    protected static function booted(){
        static::deleting(function($microservicio){
            $microservicio->clasificaciones->each(function($clasificacion){
                $clasificacion->delete();
            });
        });
    }
}
