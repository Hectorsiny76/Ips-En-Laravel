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

    public function scopeSearch($query, string $opcion1, string $opcion2){

        if(empty($opcion1) && empty($opcion2)){
            return $query->whereRaw('0 = 1');
        }

        return Foliotipo::with(['folios'])
            ->where( function ($query) use ($opcion1, $opcion2) {
                $query->where('tipo', 'ilike', "%{$opcion1}%")
                    ->orWhere('tipo', 'ilike', "%{$opcion2}%");
            })->first();
    }

}
