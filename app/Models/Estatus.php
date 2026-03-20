<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatus extends Model
{
    /** @use HasFactory<\Database\Factories\EstatusFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'estatuses';

    protected $fillable = ['nombre'];

    public function contratos(){
        return $this->hasMany(Avaloncontrato::class);
    }
}
