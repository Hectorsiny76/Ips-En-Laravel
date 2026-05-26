<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tidelprograma extends Model
{
    protected $table = 'tidelprogramas';

    protected $fillable = ['ip', 'fechamigracion'];

    use HasFactory;

    use SoftDeletes;

    public function establecimiento(){
        return $this->hasOne(Establecimiento::class);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use($termino){
            $q->WhereRaw('LOWER(ip) like ?', "%{$termino}%");
        })->orWhereHas('establecimiento', function ($estQuery) use($termino){
            $termino = strtolower($termino);
            $estQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        });
    }

}
