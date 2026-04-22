<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';

    protected $fillable = ['numero', 'nombre', 'cajas_tpvs', 'idred', 'campogerente_id', 'tidelprograma_id', 'tiendaformato_id', 'centrodecostos', 'cluster_id', 'tel', 'correo'];

    use HasFactory;

    use SoftDeletes;

    use BelongsToThrough;

    public function campogerente(){
        return $this->belongsTo(Campogerente::class, 'campogerente_id');
    }

    public function tiendaformato(){
        return $this->belongsTo(Tiendaformato::class);
    }

    public function tidelprograma(){
        return $this->belongsTo(Tidelprograma::class);
    }

    public function autocobrocajas(){
        return $this->hasMany(Autocobrotienda::class);
    }

    public function drivethrucajas(){
        return $this->hasMany(Drivethrutienda::class);
    }

    public function avaloncontrato(){
        return $this->hasOne(Avaloncontrato::class);
    }

    public function cluster(){
        return $this->belongsTo(Cluster::class);
    }

    public function binomiotienda(){
        return $this->hasOne(Binomioestablecimiento::class, 'tienda_id', 'id');
    }

    public function binomioestacion(){
        return $this->hasOne(Binomioestablecimiento::class, 'estacion_id', 'id');
    }

    public function pilotoprogramas(){
        return $this->hasMany(Pilotoestablecimiento::class);
    }

    public function estado(){
        return $this->belongsToThrough(Estado::class, [
            Mercadogerente::class,
            Mercado::class,
            Campo::class,
            Campogerente::class,
        ]);
    }

    public function mercadogerente(){
        return $this->belongsToThrough(Mercadogerente::class,[
            Mercado::class,
            Campo::class,
            Campogerente::class,
        ]);
    }

    public function establecimientotipo(){
        return $this->belongsToThrough(Establecimientotipo::class,[
            Mercado::class,
            Campo::class,
            Campogerente::class,
        ]);
    }

    public function mercado(){
        return $this->belongsToThrough(Mercado::class,[
            Campo::class,
            Campogerente::class,
        ]);
    }

    public function campo(){
        return $this->belongsToThrough(Campo::class,[
            Campogerente::class,
        ]);
    }

    public function scopeSearch($query, $termino){
        if(empty($termino)){
            return $query->whereRaw('0 = 1');
        }

        return $query->where(function ($q) use($termino){
            $q->where('numero','LIKE', '%{$termino}%')
                ->orWhere('centrodecostos','LIKE', '%{$termino}%')
                ->orWhere('nombre','LIKE', '%{$termino}%');
        });
    }

}
