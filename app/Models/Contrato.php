<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    public $table ='contrato';
    protected $primaryKey = 'idHorario';
    protected $fillable = ['idHorario','hora_inicio','hora_fin','estado','dia'];
    public $timestamps = false;

    // public function cargo(){
    //     return $this->HasOne(Cargo::class,'idCargo','idCargo');
    // }

    public function entrevista(){
        return $this->HasMany(Contrato::class,'Nhorario','Nhorario');
    }
    
}
