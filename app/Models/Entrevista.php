<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;
    public $table ='entrevista';
    protected $primaryKey = 'idEntrevista';
    protected $fillable = ['idEntrevista','idPostulacion','fecha','observacion','estado','estadoEntrevista'];
    public $timestamps = false;

    public function Postulacion(){
        return $this->HasOne(Postulacion::class,'idPostulacion','idPostulacion');
    }
    // public function persona(){
    //     return $this->HasOne(Persona::class,'DNI','DNI');
    // }

    // public function entrevista(){
    //     return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    // }
    
}
