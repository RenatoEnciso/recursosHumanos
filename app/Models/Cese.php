<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cese extends Model
{
    use HasFactory;
    public $table ='cese';
    protected $primaryKey = 'idCese';
    protected $fillable = ['idCese','fechaRegistro','idContrato','observacion','archivoCese','estado'];
    public $timestamps = false;

    public function contrato(){
        return $this->HasOne(Contrato::class,'idContrato','idContrato');
    }
    // public function persona(){
    //     return $this->HasOne(Persona::class,'DNI','DNI');
    // }

    // public function entrevista(){
    //     return $this->HasMany(Entrevista::class,'idOferta','idOferta');
    // }
    
}
