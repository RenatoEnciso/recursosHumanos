<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    public $table ='contrato';
    protected $primaryKey = 'idContrato';
    protected $fillable = ['idContrato','fecha_inicio','fecha_fin','diasVacaciones','archivoContrato','estado','idEntrevista','idTrabajador','descripcion','monto'];
    public $timestamps = false;

    // public function cargo(){
    //     return $this->HasOne(Cargo::class,'idCargo','idCargo');
    // }
    public function trabajador(){
        return $this->HasOne(Trabajador::class,'idTrabajador','idTrabajador');
    }
    public function entrevista(){
        return $this->HasOne(Entrevista::class,'idEntrevista','idEntrevista');
    }
    public function ContratoHorario(){
        return $this->HasMany(ContratoHorario::class,'idContrato','idContrato');
    }
    public function HoraExtra(){
        return $this->HasMany(HoraExtra::class,'idContrato','idContrato');
    }
    
}
