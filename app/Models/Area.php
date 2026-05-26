<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['nombre', 'descripcion'];

    use HasFactory;

    use SoftDeletes;

    public function asociados(){
        return $this->hasMany(Asociado::class);
    }

    public function despliegues(){
        return $this->hasMany(Despliegue::class);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        $termino = strtolower($termino);

        return $query->where(function ($q) use($termino){
            $q->whereRaw('LOWER(nombre) like ?', "%{$termino}%")
                ->orWhereRaw('LOWER(descripcion) like ?', "%{$termino}%");
        });
    }
}
