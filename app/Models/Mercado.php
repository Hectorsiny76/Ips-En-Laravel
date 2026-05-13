<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Mercado extends Model
{
    use HasRelationships;

    use SoftDeletes;

    use HasFactory;

    protected $table = 'mercados';

    protected $fillable = ['numero', 'mercadogerente_id', 'establecimientotipo_id'];

    public function establecimientotipo(){
        return $this->belongsTo(Establecimientotipo::class);
    }

    public function mercadogerente(){
       return $this->belongsTo(Mercadogerente::class);
    }

    public function encargados(){
        return $this->belongsToMany(Asociado::class, 'mercadoencargados');
    }

    public function campos(){
        return $this->hasMany(Campo::class);
    }

        public function campogerentes(){
        return $this->hasManyDeep(
            Campogerente::class,[
                Campo::class
            ]
        );
    }

    public function establecimientos(){
        return $this->hasManyDeep(
            Establecimiento::class,[
                Campo::class,
                Campogerente::class
            ]
        );
    }
        public function autocobrotiendas(){
        return $this->hasManyDeep(
            Autocobrotienda::class,[
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function drivethrutiendas(){
        return $this->hasManyDeep(
            Drivethrutienda::class,[
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function pilotoestablecimientos(){
        return $this->hasManyDeep(
            Pilotoestablecimiento::class,[
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }
}
