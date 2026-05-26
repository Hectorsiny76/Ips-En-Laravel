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

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use($termino) {
            $q->WhereHas('tienda', function ($estQuery) use ($termino) {
                $termino = strtolower($termino);
                $estQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%")
                    ->orWhereRaw('LOWER(numero) like ?', "%{$termino}%");
            })->orWhereHas('estacion', function ($estatusQuery) use ($termino) {
                $termino = strtolower($termino);
                $estatusQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%")
                    ->orWhereRaw('LOWER(centrodecostos) like ?', "%{$termino}%");
            });
        });
    }
}
