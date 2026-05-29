<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{

    protected $table = 'subcategorias';

    protected $fillable = ['nombre'];

    use HasFactory;

    public function clasificaciones(){
        return $this->hasMany(Clasificacione::class);
    }
}
