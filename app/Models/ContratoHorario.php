<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoHorario extends Model
{
    use HasFactory;
    public $table ='contrato_horario';
    protected $primaryKey = 'idContratoHorario';
    protected $fillable = ['idContratoHorario','lugar','idContrato','estado','idHorario'];
    public $timestamps = false;

    public function contrato(){
        return $this->HasOne(Contrato::class,'idContrato','idContrato');
    }
    public function horario(){
        return $this->HasOne(Cargo::class,'idHorario','idHorario');
    }

    // public function entrevista(){
    //     return $this->HasMany(Contrato::class,'Nhorario','Nhorario');
    // }
    
}
