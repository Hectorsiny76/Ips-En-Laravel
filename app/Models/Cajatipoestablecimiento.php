<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cajatipoestablecimiento extends Model
{
    protected $table = 'cajatipo_establecimiento';

    protected $fillable = ['cajatipo_id', 'establecimiento_id', 'numcaja'];

    public function cajatipo(){
        return $this->belongsTo(Cajatipo::class);
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        $termino = strtolower($termino);

        return $query->where(function ($q) use($termino){
            $q->WhereRaw('LOWER(numcaja) like ?', "%{$termino}%");
        })->orWhereHas('establecimiento', function ($estQuery) use($termino){
            $estQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        })->orWhereHas('cajatipo', function ($cajatipoQuery) use($termino){
            $cajatipoQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        });
    }
}
