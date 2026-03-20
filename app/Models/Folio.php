<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folio extends Model
{
    /** @use HasFactory<\Database\Factories\FolioFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'folios';

    protected $fillable = ['numero', 'titulo', 'foliotipo_id', 'descripcion'];

    public function foliotipo(){
        return $this->belongsTo(Foliotipo::class);
    }
}
