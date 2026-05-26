<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campo extends Model
{
    use HasRelationships;

    protected $table = 'campos';

    protected $fillable = ['numero', 'mercado_id'];

    use HasFactory;

    public function mercado(){
        return $this->belongsTo(Mercado::class);
    }

    public function campogerente(){
        return $this->hasOne(Campogerente::class);
    }

    public function establecimientos(){
        return $this->hasManyDeep(
            Establecimiento::class,[
                Campogerente::class
            ]
        );
    }

    public function cajatipos(){
        return $this->hasManyDeep(
            Cajatipo::class,[
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function pilotoestablecimientos(){
        return $this->hasManyDeep(
            Pilotoestablecimiento::class,[
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use($termino){
            $q->WhereRaw('LOWER(numero) like ?', "%{$termino}%");
        })->orWhereHas('campogerente', function ($campogerenteQuery) use($termino){
            $termino = strtolower($termino);
            $campogerenteQuery->whereRaw('LOWER(nombre) like ?', "%{$termino}%");
        });
    }
}
