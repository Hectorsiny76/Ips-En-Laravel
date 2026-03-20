<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Numerocaja extends Model
{
    protected $table = 'numerocajas';

    protected $fillable = ['caja'];

    use HasFactory;

    use SoftDeletes;

    public function autocobrotiendas(){
        return $this->hasMany(Autocobrotienda::class);
    }

    public function drivethrutiendas(){
        return $this->hasMany(Drivethrutienda::class);
    }
}
