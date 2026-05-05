<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tiendaformato extends Model
{
    protected $table = 'tiendaformatos';

    protected $fillable = ['nombre'];

    use HasFactory;

    use SoftDeletes;

    public function establecimientos(){
        return $this->hasMany(Establecimiento::class);
    }
}
