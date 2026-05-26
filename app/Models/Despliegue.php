<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Despliegue extends Model
{
    /** @use HasFactory<\Database\Factories\DespliegueFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'despliegues';

    protected $fillable = ['titulo', 'descripcion', 'area_id', 'inicio', 'fin'];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }
        $termino = strtolower($termino);
        return $query->where(function ($q) use($termino){
            $q->WhereRaw('LOWER(titulo) like ?', "%{$termino}%")
                ->orWhereRaw('LOWER(descripcion) like ?', "%{$termino}%");
        })->orWhereHas('area', function ($areaQuery) use($termino){
            $areaQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        });
    }

}
