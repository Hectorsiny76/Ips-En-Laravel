<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mercadogerente extends Model
{
    use HasRelationships;

    use HasFactory;

    use SoftDeletes;

    protected $table = 'mercadogerentes';

    protected $fillable = ['nombre', 'estado_id'];

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function mercado(){
        return $this->hasOne(Mercado::class);
    }

    public function campos(){
        return $this->hasManyDeep(
            Campo::class,[
                Mercado::class
            ]
        );
    }

    public function campogerentes(){
        return $this->hasManyDeep(
            Campogerente::class,[
                Mercado::class,
                Campo::class
            ]
        );
    }

    public function establecimientos(){
        return $this->hasManyDeep(
            Establecimiento::class,[
                Mercado::class,
                Campo::class,
                Campogerente::class
            ]
        );
    }

    public function cajatipos(){
        return $this->hasManyDeep(
            Cajatipo::class,[
                Mercado::class,
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function pilotoestablecimientos(){
        return $this->hasManyDeep(
            Pilotoestablecimiento::class,[
                Mercado::class,
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        $termino = strtolower($termino);

        return $query->where(function ($q) use($termino){
            $q->WhereRaw('LOWER(nombre) like ?', "%{$termino}%");
        });
    }
}
