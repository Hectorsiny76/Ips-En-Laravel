<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{

    use HasRelationships;

    use HasFactory;

    use SoftDeletes;

    protected $table = 'estados';

    protected $fillable = ['nombre'];

    public function mercadogerentes(){
        return $this->hasMany(Mercadogerente::class);
    }

    public function mercados(){
        return $this->hasManyDeep(
            Mercado::class,[
                Mercadogerente::class,
            ]
        );
    }

    public function campos(){
        return $this->hasManyDeep(
            Campo::class,[
                Mercadogerente::class,
                Mercado::class
            ]
        );
    }

    public function campogerentes(){
        return $this->hasManyDeep(
            Campogerente::class,[
                Mercadogerente::class,
                Mercado::class,
                Campo::class
            ]
        );
    }

    public function establecimientos(){
        return $this->hasManyDeep(
            Establecimiento::class,[
                Mercadogerente::class,
                Mercado::class,
                Campo::class,
                Campogerente::class
            ]
        );
    }
    public function cajatipos(){
        return $this->hasManyDeep(
            Cajatipo::class,[
                Mercadogerente::class,
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
                Mercadogerente::class,
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
