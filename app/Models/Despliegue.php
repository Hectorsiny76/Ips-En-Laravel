<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Despliegue extends Model
{
    /** @use HasFactory<\Database\Factories\DespliegueFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'despliegues';

    protected $fillable = ['titulo', 'descripcion', 'area_id', 'inicio', 'fin'];

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
