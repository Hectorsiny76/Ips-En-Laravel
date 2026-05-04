<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cajatipo extends Model
{
    protected $table = 'cajatipos';

    protected $fillable = ['establecimiento_id', 'cajatipo_id', 'numcaja'];

    use SoftDeletes;

    public function establecimientos(){
        return $this->belongsToMany(Establecimiento::class, 'cajatipo_establecimiento');
    }
}
