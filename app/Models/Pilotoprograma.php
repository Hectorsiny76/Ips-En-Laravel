<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pilotoprograma extends Model
{
    protected $table = 'pilotoprogramas';

    protected $fillable = ['titulo'];

    use HasFactory;

    use SoftDeletes;

    public function establecimientos(){
        return $this->hasMany(Pilotoestablecimiento::class, 'pilotoprograma_id', 'id');
    }
}
