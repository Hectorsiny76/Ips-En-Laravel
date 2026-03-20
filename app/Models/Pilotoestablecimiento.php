<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pilotoestablecimiento extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = 'pilotoestablecimientos';

    protected $fillable = ['establecimiento_id', 'pilotoprograma_id'];

    public function pilotoprograma(){
        return $this->belongsTo(Pilotoprograma::class, 'pilotoprograma_id');
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class, 'establecimiento_id');
    }
}
