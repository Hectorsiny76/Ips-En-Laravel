<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foliotipo extends Model
{
    /** @use HasFactory<\Database\Factories\FoliotipoFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'foliotipos';

    protected $fillable = ['tipo',];

    public function folios(){
        return $this->hasMany(Folio::class);
    }
}
