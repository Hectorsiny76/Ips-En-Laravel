<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archivotipo extends Model
{
    /** @use HasFactory<\Database\Factories\ArchivotipoFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'archivotipos';

    protected $fillable = ['nombre', 'es_link', 'mimes_permitidos', 'tam_max_kb'];

    public function archivos(){
        return $this->hasMany(Archivo::class);
    }
}
