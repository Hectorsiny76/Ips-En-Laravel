<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mercadoencargado extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'mercadoencargados';

    protected $fillable = ['mercado_id', 'asociado_id'];

    public function mercado(){
        return $this->belongsTo(Mercado::class);
    }

    public function asociado(){
        return $this->belongsTo(Asociado::class);
    }
}
