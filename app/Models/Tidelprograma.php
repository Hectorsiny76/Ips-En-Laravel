<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tidelprograma extends Model
{
    protected $table = 'tidelprogramas';

    protected $fillable = ['ip', 'fechamigracion'];

    use HasFactory;

    use SoftDeletes;

    public function tidelprograma(){
        return $this->hasOne(Establecimiento::class);
    }
}
