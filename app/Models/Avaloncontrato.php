<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaloncontrato extends Model
{
    /** @use HasFactory<\Database\Factories\AvaloncontratoFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'avaloncontratos';

    protected $fillable = ['numero', 'estatus_id', 'establecimiento_id'];

    public function estatus(){
        return $this->belongsTo(Estatus::class);
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use($termino){
            $q->WhereRaw('LOWER(numero) like ?', "%{$termino}%");
        })->orWhereHas('establecimiento', function ($estQuery) use($termino){
            $termino = strtolower($termino);
            $estQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        })->orWhereHas('estatus', function ($estatusQuery) use($termino){
            $termino = strtolower($termino);
            $estatusQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        });
    }
}
