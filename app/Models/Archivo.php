<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archivo extends Model
{
    /** @use HasFactory<\Database\Factories\ArchivoFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'archivos';

    protected $fillable = ['titulo', 'ruta', 'establecimientotipo_id', 'archivotipo_id'];

    public function archivotipo(){
        return $this->belongsTo(Archivotipo::class);
    }

    public function establecimientotipo(){
        return $this->belongsTo(Establecimientotipo::class);
    }
}
