<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{

    protected $table = 'subcategorias';

    protected $fillable = ['nombre'];

    use HasFactory;

    use SoftDeletes;

    public function clasificaciones(){
        return $this->hasMany(Clasificacione::class);
    }

        protected static function booted(){
        static::deleting(function($subCategoria){
            $subCategoria->clasificaciones->each(function($clasificacion){
                $clasificacion->delete();
            });
        });
    }
}
