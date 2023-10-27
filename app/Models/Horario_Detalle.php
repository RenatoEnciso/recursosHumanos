<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    public $table ='horario';
    protected $primaryKey = 'idHorario';
    protected $fillable = ['idHorario','lugar','hora_fin','estado','dia','Nhorario'];
    public $timestamps = false;

    // public function cargo(){
    //     return $this->HasOne(Cargo::class,'idCargo','idCargo');
    // }

    public function entrevista(){
        return $this->HasMany(Contrato::class,'Nhorario','Nhorario');
    }
    
}
