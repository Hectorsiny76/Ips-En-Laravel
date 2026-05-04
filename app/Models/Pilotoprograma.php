<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pilotoprograma extends Model
{
    protected $table = 'pilotoprogramas';

    protected $fillable = ['titulo', 'descripcion_corta', 'descripcion_larga'];

    use HasFactory;

    use SoftDeletes;

    public function establecimientos(){
        return $this->belongsToMany(Establecimiento::class, 'pilotoestablecimientos');
    }
}
