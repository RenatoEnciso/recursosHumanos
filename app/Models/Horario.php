<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    public $table ='horario';
    protected $primaryKey = 'idHorario';
    protected $fillable = ['idHorario','hora_inicio','hora_fin','dia','estado'];
    public $timestamps = false;

    // public function cargo(){
    //     return $this->HasOne(Cargo::class,'idCargo','idCargo');
    // }

    // public function entrevista(){
    //     return $this->HasMany(Contrato_Horario::class,'idHorario','idHorario');
    // }
    public function contratoHorarios(){
        return $this->hasMany(ContratoHorario::class, 'idHorario', 'idHorario');
    }
    
}
