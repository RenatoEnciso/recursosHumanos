<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    public $table ='asistencia';
    protected $primaryKey = 'idAsistencia';
    protected $fillable = ['idAsistencia','horaRegistroEntrada','horaRegistroSalida','fechaRegistro','idContrato','estado'];
    public $timestamps = false;

    // public function contratoHorario(){
    //     return $this->HasOne(ContratoHorario::class,'idContratoHorario','idContratoHorario');
    // }
    // public function persona(){
    //     return $this->HasOne(Persona::class,'DNI','DNI');
    // }

    // public function entrevista(){
    //     return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    // }
    
}
