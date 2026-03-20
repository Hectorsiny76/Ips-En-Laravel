<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Binomioestablecimiento extends Model
{
    protected $table = 'binomioestablecimientos';

    protected $fillable = ['tienda_id', 'estacion_id'];

    use HasFactory;
    
    use SoftDeletes;

    public function estacion(){
        return $this->belongsTo(Establecimiento::class, 'estacion_id', 'id');
    }

    public function tienda(){
        return $this->belongsTo(Establecimiento::class, 'tienda_id', 'id');
    }

    protected static function booted(){
        static::saving(function($binomioest){
            if($binomioest->tienda_id===$binomioest->estacion_id){
                throw new \Exception('Un establecimiento no puede ser binomio consigo mismo!');
            }
        });
    }
}
