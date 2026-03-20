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
    
    public function autocobrotiendas(){
        return $this->hasManyDeep(
            Autocobrotienda::class,[
                Mercado::class,
                Campo::class,
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function drivethrutiendas(){
        return $this->hasManyDeep(
            Drivethrutienda::class,[
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
        return $this->hasMany(Archivo::class);
    }
}
