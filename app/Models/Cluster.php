<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cluster extends Model
{
    protected $table = 'clusters';

    protected $fillable = ['nombre'];

    use SoftDeletes;

    use HasFactory;

    public function establecimientos(){
        return $this->hasMany(Establecimiento::class);
    }
}
