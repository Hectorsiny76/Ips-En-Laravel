<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaloncontrato extends Model
{
    /** @use HasFactory<\Database\Factories\AvaloncontratoFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'avaloncontratos';

    protected $fillable = ['numero', 'estatus_id', 'establecimiento_id'];

    public function estatus(){
        return $this->belongsTo(Estatus::class);
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class);
    }
}
