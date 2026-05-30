<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cajatipo extends Model
{
    protected $table = 'cajatipos';

    protected $fillable = ['nombre'];
    public function cajatipoestablecimientos(){
        return $this->hasMany(Cajatipoestablecimiento::class);
    }
}
