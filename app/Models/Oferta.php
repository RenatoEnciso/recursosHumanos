<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    public $table ='oferta';
    protected $primaryKey = 'idOferta';
    protected $fillable = ['idCargo','descripcion','fecha_inicio','fecha_fin','estado','idOferta','monto','requisitos','manualPostulante','resultados','convocatoria','numerovacantes'];
    public $timestamps = false;

    public function cargo(){
        return $this->HasOne(Cargo::class,'idCargo','idCargo');
    }

    public function entrevista(){
        return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    }
    
}
