<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establecimientotipo extends Model
{

    use HasRelationships;

    use HasFactory;

    use SoftDeletes;

    protected $table = 'establecimientotipos';

    protected $fillable = ['nombre'];

    public function mercados(){
        return $this->hasMany(Mercado::class);
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

    public function archivos(){
        return $this->belongsToMany(Archivo::class, 'archivo_esttipo');
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use ($termino) {

            $termino = '%'.strtolower($termino).'%';

            $q->whereHas('establecimientos', function ($estQuery) use ($termino) {

                $numeroCol = $estQuery->qualifyColumn('numero');
                $cdcCol  = $estQuery->qualifyColumn('centrodecostos');
                $nombreCol   = $estQuery->qualifyColumn('nombre');

                $estQuery->whereRaw("LOWER({$numeroCol}) like ?", [$termino])
                    ->orWhereRaw("LOWER({$cdcCol}) like ?", [$termino])
                    ->orWhereRaw("LOWER({$nombreCol}) like ?", $termino);
            });

        });
    }
}

