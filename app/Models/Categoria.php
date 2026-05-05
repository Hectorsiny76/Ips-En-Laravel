<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{

    protected $table = 'categorias';

    protected $fillable = ['nombre'];

    use HasFactory;

    use SoftDeletes;

    public function clasificaciones(){
        return $this->hasMany(Clasificacione::class);
    }

    protected static function booted(){
        static::deleting(function($categoria){
            $categoria->clasificaciones->each(function($clasificacion){
                $clasificacion->delete();
            });
        });
    }
}
