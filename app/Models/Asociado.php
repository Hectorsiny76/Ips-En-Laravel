<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asociado extends Model
{
    protected $table = 'asociados';

    protected $fillable = ['nombre', 'tel', 'area_id'];

    use HasFactory;

    use SoftDeletes;

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function mercado(){
        return $this->hasMany(Mercadoencargado::class);
    }
}
