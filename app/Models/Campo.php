<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campo extends Model
{
    use HasRelationships;

    protected $table = 'campos';

    protected $fillable = ['numero', 'mercado_id'];

    use HasFactory;

    use SoftDeletes;

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

    public function autocobrotiendas(){
        return $this->hasManyDeep(
            Autocobrotienda::class,[
                Campogerente::class,
                Establecimiento::class
            ]
        );
    }

    public function drivethrutiendas(){
        return $this->hasManyDeep(
            Drivethrutienda::class,[
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
}
