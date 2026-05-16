<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clasificacione extends Model
{

    protected $table = "clasificaciones";

    protected $fillable = ['categoria_id', 'subcategoria_id', 'servicio_id', 'microservicio_id'];

    use HasFactory;

    use SoftDeletes;

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }

    public function microservicio(){
        return $this->belongsTo(Microservicio::class);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use ($termino) {

            $q->whereHas('categoria', function ($categoriaQuery) use ($termino) {
                $categoriaQuery->whereRaw('LOWER(nombre) like ?', $termino);
            })
                ->orWhereHas('subcategoria', function ($subcategoriaQuery) use ($termino) {
                    $subcategoriaQuery->whereRaw('LOWER(nombre) like ?', $termino);
                })
                ->orWhereHas('servicio', function ($servicioQuery) use ($termino) {
                    $servicioQuery->whereRaw('LOWER(nombre) like ?', $termino);
                })
                ->orWhereHas('microservicio', function ($microservicioQuery) use ($termino) {
                    $microservicioQuery->whereRaw('LOWER(nombre) like ?', $termino);
                });
        });
    }

}
