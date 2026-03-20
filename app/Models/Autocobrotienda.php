<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autocobrotienda extends Model
{
    protected $table = 'autocobrotiendas';

    protected $fillable = ['establecimiento_id', 'numerocaja_id'];

    use HasFactory;
    
    use SoftDeletes;

    public function tienda(){
        return $this -> belongsTo(Establecimiento::class, 'establecimiento_id');
    }
}
