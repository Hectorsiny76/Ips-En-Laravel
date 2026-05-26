<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Znck\Eloquent\Traits\BelongsToThrough;

class Campogerente extends Model
{
    use HasRelationships;

    use HasFactory;

    use BelongsToThrough;

    protected $table = 'campogerentes';

    protected $fillable = ['nombre', 'tel', 'correo', 'campo_id'];

    public function campo(){
        return $this->belongsTo(Campo::class);
    }

    public function establecimientos(){
        return $this->hasMany(Establecimiento::class);
    }

    public function autocobrotiendas(){
        return $this->hasManyDeep(
            Autocobrotienda::class,[
                Establecimiento::class
            ]
        );
    }

    public function drivethrutiendas(){
        return $this->hasManyDeep(
            Drivethrutienda::class,[
                Establecimiento::class
            ]
        );
    }

    public function pilotoestablecimientos(){
        return $this->hasManyDeep(
            Pilotoestablecimiento::class,[
                Establecimiento::class
            ]
        );
    }

    public function establecimientotipo(){
        return $this->belongsToThrough(Establecimientotipo::class,[
            Mercado::class,
            Campo::class]);
    }
}
